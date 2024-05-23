<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;
use App\Requests\AuthRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
            // return redirect(route('admin.home'));

        } else {
            $id = (new GetPageIDAction)->run('login');
            $page = (new GetPageAction)->run($id);
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $parents = (new GetPageParentsAction)->run($id);

            return view('site.pages.login', compact('page', 'parents', 'seo'));
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect(route('home'));
        }
    }

    public function auth(AuthRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::check()) {

            if (Auth::attempt($validated)) {
                return redirect()->intended(route('home'));
                // return redirect()->intended(route('admin.home'));
            } else {
                return redirect(route('user.login'))->withErrors([
                    'form' => 'Не удалось авторизоваться, введен неверный e-mail либо пароль.'
                ]);
            }
        }
    }
}
