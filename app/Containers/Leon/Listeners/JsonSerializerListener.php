<?php

namespace App\Containers\Leon\Listeners;

use App\Containers\Leon\Events\ResponseReceivedEvent;
use App\Containers\Leon\Exceptions\InvalidResponseJsonException;

/**
 * Class JsonSerializerListener
 * @package App\Containers\Leon\Listeners
 */
class JsonSerializerListener
{
    /**
     * @param ResponseReceivedEvent $event
     */
    public function handle(ResponseReceivedEvent $event)
    {
        $response = $event->getResponse();

        if (false === strpos($response->getHeader('Content-Type'), 'application/json')) {
            return;
        }

        $parsed = json_decode($response->getBody(), true);

        if (json_last_error()) {
            throw new InvalidResponseJsonException();
        }

        $response->setBody($parsed);
    }
}
