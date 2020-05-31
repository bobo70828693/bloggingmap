<?php

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => '使用者',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '使用者id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => '使用者姓名'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => '使用者email'
            ]
        ];
    }
}
