<?php

namespace App\Containers\Messagebus\Handlers;

/**
 * Class Message
 * @package App\Containers\Messagebus\Handlers
 */
class Message
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string|array
     */
    private $message;

    /**
     * @var string Destination
     */
    private $applicationId;

    /**
     * Message constructor.
     * @param string $type
     * @param array|string $message
     * @param string $applicationId
     */
    public function __construct(string $type, $message, string $applicationId = 'core')
    {
        $this->type          = $type;
        $this->message       = $message;
        $this->applicationId = $applicationId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return array|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param array|string $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @param string $applicationId
     */
    public function setApplicationId(string $applicationId): void
    {
        $this->applicationId = $applicationId;
    }
}
