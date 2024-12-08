<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'galon_out',
        'galon_in',
        'transaction_date',
        'total_price',
        'is_active'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
} 