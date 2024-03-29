<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Page;
use App\Models\User;

class RegisterController extends Controller
{

    public function register()
    {
        if (Auth::check()) {

            return redirect(route('admin.index'));

        } else {

            $page = Page::where('url', 'login')->first();

            $parents = array();

            $current_id = $page['parent_id'];
            do {
                $parent = Page::where('id', $current_id)->first();
                array_unshift($parents, $parent);
                $current_id = $parent['parent_id'];

            } while ($current_id > 0);
           
            return view('site.registration', compact('page', 'parents'));
        }
    }

    public function createUser(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('admin.index'));
        };

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
            return redirect(route('admin.index'));
        }

        // return view('site.login', compact('page', 'tree', 'parents'))->withErrors([
        //     'formError' => 'Error text'
        // ]);
    }
}