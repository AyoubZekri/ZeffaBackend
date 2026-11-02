<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'phone1',
        'phone2',
        "is_delete"
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'hall_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
