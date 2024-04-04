<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'updated_at',
        )->orderBy('id')->get()->toArray();

        foreach ($users as $key => $user) {
            $users[$key]['updated_at'] = Carbon::parse($user['updated_at'])->toDateString();
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // $sections = User::select('id', 'name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        return view('admin.users.create');
        // return view('admin.faq.create', compact('sections'));
    }

    public function store(Request $request)
    {
        dd($request);

        // $validated = $request->validate([
        //     'name' => ['required', 'string'],
        //     'h1' => ['required', 'string'],
        //     'url' => ['required', 'string'],
        //     "text" => [],
        //     'sort_key' => ['required'],
        // ]);

        // $validated = array_merge($validated, [
        //     'create_date' => Carbon::now()->toDateTimeString(),
        //     'update_date' => Carbon::now()->toDateTimeString(),
        //     'portfolio_section_id' => 1,
        //     'user_id' => 1,
        //     'status' => 1,
        //     'seo_id' => 1,
        // ]);

        // $faq = FAQ_Questions::create($validated);

        return redirect(route('admin.users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }
}
