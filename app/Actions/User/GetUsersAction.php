<?php

namespace App\Actions\User;

use App\Models\User;
use Carbon\Carbon;

class GetUsersAction
{
    public function run($sort = 'id')
    {
        $users = User::select('id', 'name', 'email', 'updated_at')
            ->orderBy($sort)
            ->get();

        foreach ($users as $key => $user) {
            $users[$key]['updated_at'] = Carbon::parse($user['updated_at'])->toDateString();
        }

        return $users;
    }
}