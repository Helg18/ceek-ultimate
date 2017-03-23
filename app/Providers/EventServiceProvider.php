<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\PurchaseCompleted' => [
            'App\Listeners\HandlePurchaseAftermath',
        ],
        'App\Events\CardCharged' => [
            'App\Listeners\HandleCardChargedAftermath',
        ],
        'App\Events\CartPurchased' => [
            'App\Listeners\HandleCartPurchaseAftermath',
        ],
        'App\Events\UserAccountCreated' => [
            'App\Listeners\SendWelcomeEmail',
        ],
        'App\Events\AddressUpdating' => [
            'App\Listeners\SetAddressDefaults',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
