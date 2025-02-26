<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'image',
        'publish_date',
        'n_likes',
        'belongs_to'
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];
}
