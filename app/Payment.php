<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'failed', 'transaction_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
