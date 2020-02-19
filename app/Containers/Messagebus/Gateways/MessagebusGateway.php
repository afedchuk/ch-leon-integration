<?php

namespace App\Containers\Messagebus\Gateways;

use App\Containers\Messagebus\Contracts\MessagebusGatewayInterface;
use App\Containers\Messagebus\Contracts\MessageHandlerInterface;
use App\Containers\Messagebus\Handlers\Message;
use Illuminate\Support\Facades\Config;

class MessagebusGateway implements MessagebusGatewayInterface
{
    /**
     * @var MessageHandlerInterface
     */
    private $handler;

    /**
     * MessagebusGateway constructor.
     * @param MessageHandlerInterface $handler
     */
    public function __construct(MessageHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * {@inheritdoc}
     */
    public function sendBookingUpdates(array $updates): void
    {
        $message = new Message(
            Config::get('messagebus-container.messages.bookings.update'),
            $updates
        );

        $this->handler->handle($message);
    }
}
