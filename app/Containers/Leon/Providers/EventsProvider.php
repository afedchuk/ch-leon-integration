<?php

namespace App\Containers\Leon\Providers;

use App\Containers\Leon\Events\ResponseReceivedEvent;
use App\Containers\Leon\Listeners\JsonSerializerListener;
use App\Containers\Leon\Listeners\LogResponsesToS3Listener;
use App\Ship\Parents\Providers\EventsProvider as AbstractEventsProvider;

/**
 * Class EventsProvider
 * @package App\Containers\Leon\Providers
 */
class EventsProvider extends AbstractEventsProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ResponseReceivedEvent::class => [
            // S3 must be the first
            LogResponsesToS3Listener::class,
            JsonSerializerListener::class,
        ],
    ];


    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

}
