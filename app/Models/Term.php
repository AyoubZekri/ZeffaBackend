<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'type'
    ];

    public function contents()
    {
        return $this->hasMany(
            TermContent::class,
            'term_uuid',
            'uuid'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
