<?php

namespace App\Actions\User;

class UpdateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public $password,
        public $status,
    ) {
        //
    }
}
