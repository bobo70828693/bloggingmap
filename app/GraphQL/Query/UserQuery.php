<?php

namespace App\GraphQL\Query;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'Users Query'
    ];

    /**
     * query 回傳的資料格式
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    /**
     * 在 query 時可能會傳入的參數設定
     */
    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => (Type::int())],
            'name' => ['name' => 'name', 'type' => (Type::string())],
        ];
    }

    /**
     * 接收到 query 時，處理以及回傳
     */
    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $users = new User;

        if (isset($args['id'])) {
            $users = $users->where('id', $args['id']);
        }

        if (isset($args['name'])) {
            $users = $users->where('name', $args['name']);
        }

        return $users->get();
    }
}
