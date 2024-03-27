<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;


class HomeController extends Controller
{
    public function __invoke()
    {
        $res = Page::select('id', 'name', 'parent_id', 'url')->where('menu_show', 1)->orWhere('id', 1)->orderBy('menu_sort')->get()->toArray();

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
