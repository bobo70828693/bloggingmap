<?php

namespace App\GraphQL\Type;

use App\Models\Tag;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TagType extends GraphQLType
{
    protected $attributes = [
        'name' => 'tag',
        'description' => '標籤',
        'model' => Tag::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '標籤id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => '標籤名稱'
            ],
            'comment' => [
                'type' => Type::string(),
                'description' => '標籤備註'
            ]
        ];
    }
}
