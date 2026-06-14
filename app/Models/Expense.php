<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'type',
        'description',
        'value',
        'date_perry'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
