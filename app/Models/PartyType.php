<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartyType extends Model
{
    protected $table = 'party_type';

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'content',
        'basic_price',
        'seasonal_price',
        'icon',
        'guest_pricing_tiers',
        "is_delete"
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'type_of_party_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}