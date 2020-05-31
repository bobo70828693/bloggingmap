<?php

namespace App\GraphQL\Query;

use App\Models\Blog;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BlogQuery extends Query
{
    protected $attribute = [
        'name' => 'Blogs Query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('blog'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => (Type::int())],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $blogs = new Blog;

        if (isset($args['id'])) {
            $blogs = $blogs->where('id', $args['id']);
        }

        return $blogs->get();
    }
}
