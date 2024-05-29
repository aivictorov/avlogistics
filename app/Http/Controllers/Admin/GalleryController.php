<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Gallery\CreateGalleryAction;
use App\Actions\Gallery\CreateGalleryData;
use App\Actions\Gallery\CreateGalleryItemAction;
use App\Actions\Gallery\CreateGalleryItemData;
use App\Actions\Gallery\UpdateGalleryAction;
use App\Actions\Gallery\UpdateGalleryData;
use App\Actions\Gallery\UpdateGalleryItemAction;
use App\Actions\Gallery\UpdateGalleryItemData;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Page\GetPagesAction;
use App\Http\Controllers\Controller;
use App\Models\Galleries;
use App\Models\GalleryItems;
use App\Models\Image;
use App\Requests\GalleryRequest;
use App\Requests\SearchRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $galleries = Galleries::where('name', 'like', '%' . $search . '%')->paginate(15);
            $galleries->appends(['search' => $search]);
        } else {
            $galleries = Galleries::paginate(15);
        }

        return view('admin.pages.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $pages = (new GetPagesAction)->run();

        return view('admin.pages.galleries.create', compact('pages'));
    }

    public function store(GalleryRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {

            $gallery = (new CreateGalleryAction)->run(
                new CreateGalleryData(
                    name: $validated['name'],
                    page_id: $validated['page_id'],
                    status: $validated['status'],
                )
            );

            if ($request->has('images')) {
                foreach ($validated['images'] as $item) {
                    $galleryItem = (new CreateGalleryItemAction)->run(
                        new CreateGalleryItemData(
                            gallery_id: $gallery->id,
                            text: "...",
                            sort: 1,
                            portfolio_id: null,
                        )
                    );

                    (new CreateImageAction)->run(
                        $item,
                        new CreateImageData(
                            image: $item->getClientOriginalName(),
                            parent_type: 'gallery_item',
                            parent_id: $galleryItem->id,
                        )
                    );
                }
            }
        }, 3);

        return redirect(route('admin.galleries.index'));
    }

    public function edit($id)
    {
        $gallery = Galleries::find($id);

        $items = GalleryItems::where('gallery_id', $id)->get()->sortBy('id');

        foreach ($items as $key => $item) {
            $image = Image::where([
                ['parent_type', 'gallery_item'],
                ['parent_id', $item['id']],
            ])->first();

            $items[$key]['image'] = $image;
        }

        $pages = (new GetPagesAction)->run();

        return view('admin.pages.galleries.edit', compact('pages', 'gallery', 'items'));
    }

    public function update(GalleryRequest $request, $id)
    {
        $gallery = Galleries::find($id);
        $items = GalleryItems::where('gallery_id', $gallery->id)->get();
        $validated = $request->validated();

        DB::transaction(function () use ($gallery, $validated, $items, $request) {
            (new UpdateGalleryAction)->run(
                $gallery,
                new UpdateGalleryData(
                    name: $validated['name'],
                    page_id: $validated['page_id'],
                    status: $validated['status'],
                )
            );

            foreach ($items as $item) {
                if (isset($validated['items'][$item->id])) {
                    (new UpdateGalleryItemAction)->run(
                        $item,
                        new UpdateGalleryItemData(
                            text: $validated['items'][$item->id]['text'],
                            sort: $validated['items'][$item->id]['sort'],
                        )
                    );
                }
            };

            if ($request->has('images')) {
                foreach ($validated['images'] as $item) {
                    $galleryItem = (new CreateGalleryItemAction)->run(
                        new CreateGalleryItemData(
                            gallery_id: $gallery->id,
                            text: "...",
                            sort: 1,
                            portfolio_id: null,
                        )
                    );

                    (new CreateImageAction)->run(
                        $item,
                        new CreateImageData(
                            image: $item->getClientOriginalName(),
                            parent_type: 'gallery_item',
                            parent_id: $galleryItem->id,
                        )
                    );
                }
            }
        }, 3);

        Session::flash('success', 'Изменения сохранены');

        return redirect(route('admin.galleries.index'));
    }

    public function destroy($id)
    {
        $gallery = Galleries::find($id);

        $items = GalleryItems::where([
            ['gallery_id', $gallery->id],
        ])->get();

        $images = [];

        foreach ($items as $item) {
            $image = Image::where([
                ['parent_type', 'gallery_item'],
                ['parent_id', $item->id],
            ])->first();

            array_push($images, $image);
        }

        DB::transaction(function () use ($gallery, $items, $images) {

            $gallery->delete();

            foreach ($items as $item) {
                $item->delete();
            }

            foreach ($images as $image) {
                (new DestroyImageAction)->run($image);
            }
        }, 3);

        return redirect(route('admin.galleries.index'));
    }

    public function publish($id, Request $request)
    {
        $status = $request->get('published');

        Galleries::find($id)->update([
            'status' => $status,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back();
    }
}