<?php

namespace App\Containers\Messagebus\Events;

use App\Ship\Parents\Events\Event;
use Interop\Amqp\AmqpMessage;

class MessageSentEvent extends Event
{
    /**
     * @var AmqpMessage
     */
    private $message;

    /**
     * MessageSentEvent constructor.
     * @param AmqpMessage $message
     */
    public function __construct(AmqpMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return AmqpMessage
     */
    public function getMessage(): AmqpMessage
    {
        return $this->message;
    }
}
