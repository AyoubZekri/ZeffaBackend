<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'cat_uuid',
        'name',
        "is_delete",
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(
            CatDish::class,
            'cat_uuid',
            'uuid'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}