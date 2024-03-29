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
            return redirect(route('admin.main'));

        } else {

            $page = Page::where('url', 'login')->first();

            $parents = array();

            $current_id = $page['parent_id'];

            do {
                $parent = Page::where('id', $current_id)->first();
                array_unshift($parents, $parent);
                $current_id = $parent['parent_id'];

            } while ($current_id > 0);

            return view('site.login', compact('page', 'parents'));
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect(route('main'));
        }
    }

    public function auth(Request $request)
    {
        if (!Auth::check()) {

            $formFields = $request->only(['email', 'password']);

            if (Auth::attempt($formFields)) {
                return redirect()->intended(route('admin.main'));
                // return redirect(route('admin.index'));
            }

            return redirect(route('user.login'))->withErrors([
                'email' => 'не удалось авторизоваться'
            ]);
        }
    }
}
