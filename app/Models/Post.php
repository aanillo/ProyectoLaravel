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

    // En el modelo Post.php
    public function user(){
        return $this->belongsTo(User::class, 'belongs_to');
    }

}
