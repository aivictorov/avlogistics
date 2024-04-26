<?php

namespace App\Actions\User;

use App\Models\User;
use Carbon\Carbon;

class GetUsersAction
{
    public function run($sort = 'id')
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')
            ->orderBy($sort)
            ->get();

        return $users;
    }
}