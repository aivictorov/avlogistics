<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class AuthUser
{
    public function run($user): void
    {
        Auth::login($user);
    }
}