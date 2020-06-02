<?php

namespace App\Services\Account;

use App\Services\Account\BaseAuth;
use Illuminate\Support\Facades\Auth;

class Login extends BaseAuth
{
    public function __construct()
    {
    }

    public function login($input): bool
    {
        return $this->authorize($input);
    }

    public function logout()
    {
        Auth::logout();
    }
}
