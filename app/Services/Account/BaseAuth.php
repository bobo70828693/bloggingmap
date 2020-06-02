<?php

namespace App\Services\Account;
use Illuminate\Support\Facades\Auth;

abstract class BaseAuth
{
    public function authorize($input): bool
    {
        $email = $input['email'];
        $password = $input['password'];

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return true;
        } else {
            return false;
        }
    }
}
