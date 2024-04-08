<?php

namespace App\Actions\User;

class CreateUserData
{
    public function __construct(
        public $name,
        public $email,
        public $password,
    ) {
        //
    }
}
