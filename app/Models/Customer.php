<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'is_active'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
} 