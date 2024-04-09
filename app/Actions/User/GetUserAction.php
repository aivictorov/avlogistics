<?php

namespace App\Actions\User;

use App\Models\User;

class GetUserAction
{
    public function run($id)
    {
        return User::find($id);
    }
}
