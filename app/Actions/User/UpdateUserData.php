<?php

namespace App\Actions\User;

class UpdateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        // public string $current_password,
        public string $password,
    ) {
        //
    }
}
