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
use App\Services\Account\Register;
use Exception;

class RegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Register'
    ];

    public function __construct()
    {
        $this->register = new Register();
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

        try{
            DB::beginTransaction();

            $register = $this->userRepository->create($args);

            if ($register) {
                $checkAuth = $this->register->authorize($args);

                if ($checkAuth) {
                    DB::commit();
                    return $token;
                } else {
                    DB::rollBack();
                    throw new Exception('register user account authorize failed');
                }
            } else {
                DB::rollBack();
                throw new Exception('register user account failed');
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('error with user register errorMsg: ' . $e->getMessage());
        }
    }
}
