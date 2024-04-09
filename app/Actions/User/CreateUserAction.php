<?php

namespace App\Actions\User;

use App\Actions\User\CreateUserData;
use App\Models\User;
use Carbon\Carbon;

class CreateUserAction
{
    public function run(CreateUserData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,

            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}