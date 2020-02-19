<?php

namespace App\Containers\Leon\Listeners;

use App\Containers\Logging\Loggers\S3Logger;
use App\Containers\Leon\Events\ResponseReceivedEvent;

/**
 * Class S3LogsStoreListener
 * @package App\Containers\Leon\Listeners
 */
class LogResponsesToS3Listener
{
    /**
     * @var S3Logger
     */
    private $s3Logger;

    /**
     * S3LogsStoreListener constructor.
     * @param S3Logger $s3Logger
     */
    public function __construct(S3Logger $s3Logger)
    {
        $this->s3Logger = $s3Logger;
    }

    /**
     * @param ResponseReceivedEvent $event
     */
    public function handle(ResponseReceivedEvent $event)
    {
        $request  = $event->getRequest();
        $response = $event->getResponse();

        $this->s3Logger->append(S3Logger::TYPE_RESPONSES, $response->getBody());
    }
}
