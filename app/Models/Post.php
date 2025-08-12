<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'menu_id',
        'title',
        'content',
        'subtitle',
        'thumbnail',
        'created_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'updated_at',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::deleting(function ($post) {
            $post->deleted_by = auth()->id();
            $post->saveQuietly();
        });
    }

    // Additional methods and relationships can be defined here
}
