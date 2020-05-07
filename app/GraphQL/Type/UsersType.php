<?php

namespace App\GraphQL\Type;

use App\Models\Users;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UsersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'users',
        'description' => '使用者',
        'model' => Users::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '商品id',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => '使用者名稱',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => '使用者電郵',
            ],
        ];
    }
}
