<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $dateFormat = 'Y-m-d H:i:s';

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
