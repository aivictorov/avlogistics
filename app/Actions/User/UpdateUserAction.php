<?php

namespace App\Actions\User;

use App\Actions\User\UpdateUserData;

class UpdateUserAction
{
    public function run($user, UpdateUserData $data)
    {
        if (!$data->password) {
            return $user->update([
                'name' => $data->name,
                'email' => $data->email,
                'status' => $data->status,
            ]);
        } else {
            return $user->update([
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'status' => $data->status,
            ]);
        }
    }
}
