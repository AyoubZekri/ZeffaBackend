<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermContent extends Model
{
    protected $table = 'terms_content';

    protected $fillable = [
        'uuid',
        'term_uuid',
        'user_id',
        'content'
    ];

    public function term()
    {
        return $this->belongsTo(
            Term::class,
            'term_uuid',
            'uuid'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
