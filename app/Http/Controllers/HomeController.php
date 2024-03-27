<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;


class HomeController extends Controller
{
    public function __invoke()
    {
        // $menu = Page::where([
        //     ['parent_id', '=', 1],
        //     ['menu_show', '=', 1],
        // ])
        //     ->get();

        $res = Page::all('id', 'name', 'parent_id', 'url')->toArray();

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


        return view('site.index', compact('tree'));
    }
}
