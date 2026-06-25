<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDate extends Model
{
    protected $fillable = [
        'uuid',
        'reservation_uuid',
        'user_id',
        'title',
        'type',
        'start_date',
        'end_date',
        'date',
        "is_delete"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
