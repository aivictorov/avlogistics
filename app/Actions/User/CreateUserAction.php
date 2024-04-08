<?php

namespace App\Actions\User;

use App\Actions\User\CreateUserData;
use App\Models\User;

class CreateUserAction
{
    public function run(CreateUserData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
            // 'password' => bcrypt($data->password),
        ]);
    }
}