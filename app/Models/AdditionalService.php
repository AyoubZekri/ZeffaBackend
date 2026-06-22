<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'price',
    ];
}
