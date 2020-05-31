<?php

namespace App\GraphQL\Mutation;

use App\Models\Blog;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\DB;

class CreateBlogMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateBlog'
    ];

    public function type(): Type
    {
        return GraphQL::type('blog');
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::int())
            ],
            'tag_id' => [
                'name' => 'tag_id',
                'type' => Type::nonNull(Type::int())
            ],
            'is_show' => [
                'name' => 'is_show',
                'type' => Type::nonNull(Type::int())
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'latitude' => [
                'name' => 'latitude',
                'type' => Type::nonNull(Type::float())
            ],
            'longitude' => [
                'name' => 'longitude',
                'type' => Type::nonNull(Type::float())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $blogId = DB::table('blogs')->insertGetId($args);
        $blogInfo = DB::table('blogs')->find($blogId);
        return $blogInfo;
    }
}
