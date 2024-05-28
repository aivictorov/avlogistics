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
use App\Requests\SearchRequest;
use App\Requests\UserCreateRequest;
use App\Requests\UserEditRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $users = User::where('name', 'like', '%' . $search . '%')->paginate(15);
            $users->appends(['search' => $search]);
        } else {
            $users = User::paginate(15);
        }

        // $users = (new GetUsersAction)->run();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $validated = $request->validated();

        $user = (new CreateUserAction)->run(
            new CreateUserData(
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
                role: $validated['role'],
                status: $validated['status'],
            )
        );

        return redirect(route('admin.pages.users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.pages.users.edit', compact('user'));
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

        return redirect(route('admin.pages.users.index'));
    }

    public function destroy($id)
    {
        if (User::count() > 1) {
            $user = User::find($id);
            $user->delete();
            return redirect(route('admin.pages.users.index'));
        } else {
            Session::flash('danger', 'Нельзя удалить единственного пользователя');
            return redirect()->back();
        }
    }

    public function publish($id, Request $request)
    {
        $status = $request->get('published');

        User::find($id)->update([
            'status' => $status,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back();
    }
}
