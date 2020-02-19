<?php

namespace App\Containers\Messagebus\Extensions;

use Enqueue\Consumption\Context;
use Enqueue\Consumption\ExtensionInterface;
use Enqueue\Consumption\Result;

class JsonDecodeExtension implements ExtensionInterface
{
    public function onStart(Context $context)
    {
        // TODO: Implement onStart() method.
    }

    public function onBeforeReceive(Context $context)
    {
        //
    }

    public function onPreReceived(Context $context)
    {
        $message = $context->getPsrMessage();

        $decoded = json_decode($message->getBody(), true);

        if (json_last_error()) {
            $context->setResult(Result::REJECT);
        }

        $message->setBody($decoded);
    }

    public function onResult(Context $context)
    {
        // TODO: Implement onResult() method.
    }

    public function onPostReceived(Context $context)
    {
        // TODO: Implement onPostReceived() method.
    }

    public function onIdle(Context $context)
    {
        // TODO: Implement onIdle() method.
    }

    public function onInterrupted(Context $context)
    {
        // TODO: Implement onInterrupted() method.
    }
}
