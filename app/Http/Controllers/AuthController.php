<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Page;
use App\Models\User;
use App\Models\SEO;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect(route('admin.home'));

        } else {
            $page = Page::where('url', 'login')->first();
            $parents = Page::parents('login');
            $seo = SEO::find($page['seo_id']);

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


    public function register()
    {
        if (Auth::check()) {
            return redirect(route('admin.index'));

        } else {
            $page = Page::where('url', 'login')->first();
            $parents = Page::parents('login');
            return view('site.registration', compact('page', 'parents'));
        }
    }

    public function createUser(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('admin.index'));
        }

        $validatedFields = $request->validate([
            // 'name' => ['required', 'string', 'max:64'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create($validatedFields);

        if ($user) {
            Auth::login($user);
            // auth()->login($user);
            return redirect(route('admin.home'));
        }

        // return view('site.login', compact('page', 'tree', 'parents'))->withErrors([
        //     'formError' => 'Error text'
        // ]);
    }
}
