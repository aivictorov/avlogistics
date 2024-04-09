<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect(route('admin.home'));

        } else {
            $id = (new GetPageIDAction)->run('login');
            $page = (new GetPageAction)->run($id);
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $parents = (new GetPageParentsAction)->run($id);

            return view('site.login', compact('page', 'parents', 'seo'));
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect(route('home'));
        }
    }

    public function auth(Request $request)
    {
        if (!Auth::check()) {
            $formFields = $request->only(['email', 'password']);

            if (Auth::attempt($formFields)) {
                return redirect()->intended(route('admin.home'));
            }

            return redirect(route('user.login'))->withErrors([
                'email' => 'не удалось авторизоваться'
            ]);
        }
    }
}
