<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

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

        $menu = Page::select('id', 'name', 'url')
            ->where([
                ['parent_id', '=', 1],
                ['menu_show', '=', 1],
            ])
            ->get();

        $parent = Page::where('id', $page->parent_id)->first();

        $children = Page::where('parent_id', $page->id)->get();



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


        $res = Page::all('id', 'name', 'parent_id')->toArray();

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

        // dd($tree);

        return view('site.page', compact('page', 'menu', 'parent', 'children', 'tree'));
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
