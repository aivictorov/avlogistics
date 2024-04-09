<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\CreateUserAction;
use App\Actions\User\CreateUserData;
use App\Actions\User\GetUserAction;
use App\Actions\User\GetUsersAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Requests\UserEditRequest;
use App\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = (new GetUsersAction)->run();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $user = (new CreateUserAction)->run(
            new CreateUserData(
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
            )
        );

        return redirect(route('admin.users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update($id, UserEditRequest $request)
    {
        $user = (new GetUserAction)->run($id);
        $validated = $request->validated();

        (new UpdateUserAction)->run(
            $user,
            new UpdateUserData(
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
            )
        );

        return redirect(route('admin.users.index'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
