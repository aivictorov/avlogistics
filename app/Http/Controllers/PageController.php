<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Image;

class PageController extends Controller
{
    public function index()
    {
        return view('site.page');
        // "Страница список постов";
    }

    public function create()
    {
        return "Страница создание поста";
    }

    public function store()
    {
        return "Запрос создание поста";
    }

    public function show($url)
    {
        $page = Page::where('url', $url)->first();

        $image = Image::where([['parent_id', $page->id], ['parent_type', 'page_avatar']])->first();

        if ($image) {
            $image_path = "\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }

        $res = Page::select('id', 'name', 'parent_id', 'url')->where('menu_show', 1)->orWhere('id', 1)->orderBy('menu_sort')->get()->toArray();

        $parents = array();

        $current_id = $page['parent_id'];

        do {
            $parent =  Page::where('id', $current_id)->first();
            array_unshift($parents, $parent);
            $current_id = $parent['parent_id'];
           
        } while ($current_id > 0);


        $nodes = array();

        foreach ($res as $value) {
            $nodes[$value['id']] = $value;
        }

        function getTree($dataset)
        {
            $tree = array();

            foreach ($dataset as $id => &$node) {

                if ($node['parent_id'] === 0) {
                    $tree[$id] = &$node;
                } else {
                    $dataset[$node['parent_id']]['children'][$id] = &$node;
                }
            }
            return $tree;
        }

        $tree = getTree($nodes);

        return view('site.page', compact('page', 'tree', 'parents', 'image_path'));
    }

    public function edit()
    {
        return "Страница изменение поста";
    }

    public function update()
    {
        return "Запрос изменение поста";
    }

    public function destroy()
    {
        return "Запрос удаления поста";
    }
}


// $menu = Page::select('id', 'name', 'url')
//     ->where([
//         ['parent_id', '=', 1],
//         ['menu_show', '=', 1],
//     ])
//     ->get();

// $parent = Page::where('id', $page->parent_id)->first();

// $children = Page::where('parent_id', $page->id)->get();

// $items = Page::all('id', 'name', 'parent_id')->toArray();

// $tree = array();

// foreach ($items as $key => $item) {
//     if ($item['parent_id'] === 0) {
//         $tree[0] = $item;
//     }
// }

// foreach ($items as $key => $item) {
//     if (!isset($tree[0]['children'])) {
//         $tree[0]['children'] = array();
//     }
//     if ($item['parent_id'] === $tree[0]['id']) {
//         array_push($tree[0]['children'], $item);
//     }
// }

// foreach ($items as $key => $item) {
//     foreach ($tree[0]['children'] as $key => $child) {
//         if (!isset($tree[0]['children'][$key]['children'])) {
//             $tree[0]['children'][$key]['children'] = array();
//         }
//         if ($item['parent_id'] === $child['id']) {
//             array_push($tree[0]['children'][$key]['children'], $item);
//         }
//     }
// }

// foreach ($items as $key => $item) {
//     foreach ($tree[0]['children'] as $key => $child) {
//         foreach ($tree[0]['children'][$key]['children'] as $subkey => $subchild) {
//             if (!isset($tree[0]['children'][$key]['children'][$subkey]['children'])) {
//                 $tree[0]['children'][$key]['children'][$subkey]['children'] = array();
//             }
//             if ($item['parent_id'] === $subchild['id']) {
//                 array_push($tree[0]['children'][$key]['children'][$subkey]['children'], $item);
//             }
//         }
//     }
// }
