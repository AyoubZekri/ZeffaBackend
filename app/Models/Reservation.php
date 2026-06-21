<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'username',
        'phone_numper',
        'numperReservation',
        'booking_date',
        'booking_period',
        'type_of_party_uuid',
        'price',
        'notes',
        'deposit',
        'remaining_amount',
        'number_of_men',
        'number_of_women'
    ];

    public function partyType()
    {
        return $this->belongsTo(
            PartyType::class,
            'type_of_party_uuid',
            'uuid'
        );
    }

    public function dishes()
    {
        return $this->hasMany(
            ReservationDish::class,
            'reservation_uuid',
            'uuid'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}