<?php

namespace App\Actions\User;

use App\Actions\User\UpdateUserData;

class UpdateUserAction
{
    public function run($user, UpdateUserData $data)
    {
        return $user->update([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);
    }
}
