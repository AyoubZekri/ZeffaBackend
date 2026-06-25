<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatDish extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'image',
        "is_delete"
    ];

    public function dishes()
    {
        return $this->hasMany(
            Dish::class,
            'cat_uuid',
            'uuid'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
