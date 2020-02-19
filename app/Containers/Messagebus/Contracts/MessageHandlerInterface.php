<?php

namespace App\Containers\Messagebus\Contracts;

use App\Containers\Messagebus\Handlers\Message;

interface MessageHandlerInterface
{
    /**
     * @param Message $message
     */
    public function handle(Message $message): void;
}
