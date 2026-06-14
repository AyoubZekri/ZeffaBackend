<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDish extends Model
{
    protected $fillable = [
        'uuid',
        'reservation_uuid',
        'dishes_uuid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}