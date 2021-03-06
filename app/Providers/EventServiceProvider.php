<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\UserRequestedActivationEmail' => [
            'App\Listeners\Auth\SendActivationEmail',
        ],

        'App\Events\Order\OrderWasCreated' => [
            'App\Listeners\Order\RecordFailedPayment',
            'App\Listeners\Order\MarkOrderPaid',
            'App\Listeners\Order\RecordSuccessfulPayment',
            'App\Listeners\Order\UpdateStock',
            'App\Listeners\Order\EmptyCart',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
