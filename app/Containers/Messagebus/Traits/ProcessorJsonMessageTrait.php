<?php

namespace App\Containers\Messagebus\Traits;

use App\Containers\Messagebus\Exceptions\InvalidJsonException;
use Interop\Queue\PsrMessage;

trait ProcessorJsonMessageTrait
{
    /**
     * @param PsrMessage $message
     * @return mixed
     */
    public function decode(PsrMessage $message)
    {
        if (false === strpos($message->getHeader('content_type'), 'application/json')) {
            throw new InvalidJsonException(
                "Invalid JSON. Body: " . $message->getBody()
            );
        }

        $decoded = json_decode($message->getBody(), true);

        if (json_last_error()) {
            throw new InvalidJsonException(
                "Invalid JSON. Body: " . $message->getBody()
            );
        }

        return $decoded;
    }
}
