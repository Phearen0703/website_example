<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    // protected $table = "";
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    
    ];
    public $timestamps = false;

      protected static function booted()
    {
        static::deleting(function ($menu) {
            $menu->deleted_by = auth()->id();
            $menu->saveQuietly();
        });
    }
}
