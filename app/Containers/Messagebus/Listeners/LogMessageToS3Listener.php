<?php

namespace App\Containers\Messagebus\Listeners;

use App\Containers\Logging\Loggers\S3Logger;
use App\Containers\Messagebus\Events\MessageSentEvent;

class LogMessageToS3Listener
{
    /**
     * @var S3Logger
     */
    private $s3Logger;

    /**
     * LogMessagesToS3Listener constructor.
     * @param S3Logger $s3Logger
     */
    public function __construct(S3Logger $s3Logger)
    {
        $this->s3Logger = $s3Logger;
    }

    /**
     * @param MessageSentEvent $event
     */
    public function handle(MessageSentEvent $event)
    {
        $message = $event->getMessage();

        $this->s3Logger->append(S3Logger::TYPE_MESSAGES, $message->getBody());
    }
}
