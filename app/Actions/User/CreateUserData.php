<?php

namespace App\Actions\User;

class CreateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
        //
    }
}
