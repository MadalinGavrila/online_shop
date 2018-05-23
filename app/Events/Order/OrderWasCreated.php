<?php

namespace App\Events\Order;

use App\Cart\Cart;
use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrderWasCreated
{
    use Dispatchable, SerializesModels;

    public $order;

    public $cart;

    public $transaction;

    public function __construct(Order $order, Cart $cart, $transaction)
    {
        $this->order = $order;

        $this->cart = $cart;

        $this->transaction = $transaction;
    }
}
