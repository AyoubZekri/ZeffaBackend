<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationService extends Model
{
    protected $fillable = [
        'uuid',
        'reservation_uuid',
        'service_uuid',
        'user_id',
        "is_delete"
    ];
}
