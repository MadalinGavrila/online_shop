<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordSuccessfulPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        if($event->transaction->success){

            $event->order->payment()->create([
                'failed' => false,
                'transaction_id' => $event->transaction->transaction->id
            ]);

        }
    }
}
