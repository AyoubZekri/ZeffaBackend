<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'description',
        "is_delete"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
