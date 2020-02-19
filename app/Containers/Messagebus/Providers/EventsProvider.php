<?php

namespace App\Containers\Messagebus\Providers;

use App\Containers\Messagebus\Events\MessageSentEvent;
use App\Containers\Messagebus\Listeners\LogMessageToS3Listener;
use App\Ship\Parents\Providers\EventsProvider as AbstractEventsProvider;

/**
 * Class EventsProvider
 * @package App\Containers\Messagebus\Providers
 */
class EventsProvider extends AbstractEventsProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageSentEvent::class => [
            // S3 must be first
            LogMessageToS3Listener::class,
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
