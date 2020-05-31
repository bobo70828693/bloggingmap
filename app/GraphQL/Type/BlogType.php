<?php

namespace App\GraphQL\Type;

use App\Models\Blog;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BlogType extends GraphQLType
{
    protected $attributes = [
        'name' => 'blog',
        'description' => '部落格',
        'model' => Blog::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '部落格id'
            ],
            'user_id' => [
                'type' => Type::int(),
                'description' => '使用者對應id'
            ],
            'tag_id' => [
                'type' => Type::int(),
                'description' => '標籤對應id'
            ],
            'tag' => [
                'type' => GraphQL::type('tag'),
                'description' => '標籤名'
            ],
            'is_show' => [
                'type' => Type::int(),
                'description' => '是否顯示'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => '內容'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => '緯度'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => '經度'
            ]
        ];
    }
}
