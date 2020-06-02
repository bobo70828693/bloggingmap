<?php

namespace App\GraphQL\Mutation\Auth;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Account\Login;
use Exception;
use Illuminate\Support\Facades\Log;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Login'
    ];

    public function __construct()
    {
        $this->login = new Login();
    }

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'regex:/^\w*$/', 'max:8']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        try {
            $login = $this->login->login($args);

            if ($login) {
                $user = Auth::user();
                return $user->token;
            } else {
                throw new Exception('user login failed');
            }
        } catch (Exception $e) {
            throw new Exception('error with login errorMsg: ' . $e->getMessage());
        }
    }
}
