<?php

namespace App\Containers\Messagebus\Handlers;

use App\Containers\Messagebus\Contracts\MessageClientInterface;
use App\Containers\Messagebus\Contracts\MessageHandlerInterface;

class MessageHandler implements MessageHandlerInterface
{
    /**
     * @var MessageClientInterface
     */
    private $client;

    /**
     * MessageHandler constructor.
     * @param MessageClientInterface $client
     */
    public function __construct(MessageClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Message $message): void
    {
        $this->client->send(
            $message->getType(),
            [
                'data' => $message->getMessage(),
            ],
            $message->getApplicationId()
        );
    }
}
