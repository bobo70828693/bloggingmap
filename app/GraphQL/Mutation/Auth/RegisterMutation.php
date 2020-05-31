<?php

namespace App\GraphQL\Mutation\Auth;

use App\Repositories\UserRepository;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Register'
    ];

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'max:128']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'regex:/^\w*$/', 'max:8']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'unique:users', 'email']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $token = Str::random(64);
        $args['token'] = $token;

        $register = $this->userRepository->create($args);

        if (!$register) {
            return null;
        }

        return $token;
    }
}
