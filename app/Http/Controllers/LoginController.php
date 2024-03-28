<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login()
    {

        if (Auth::check()) {

            return redirect(route('admin.index'));

        } else {

            $page = Page::where('url', 'login')->first();

            $res = Page::select('id', 'name', 'parent_id', 'url')->where('menu_show', 1)->orWhere('id', 1)->orderBy('menu_sort')->get()->toArray();

            $parents = array();

            $current_id = $page['parent_id'];

            do {
                $parent = Page::where('id', $current_id)->first();
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

            return view('site.login', compact('page', 'tree', 'parents'));
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect(route('main'));
        }
    }

    public function authentificate(Request $request)
    {
        if (!Auth::check()) {

            $formFields = $request->only(['email', 'password']);

            if (Auth::attempt($formFields)) {
                return redirect()->intended(route('admin.index'));
                // return redirect(route('admin.index'));
            }

            return redirect(route('login'))->withErrors([
                'email' => 'не удалось авторизоваться'
            ]);
        }
    }
}
