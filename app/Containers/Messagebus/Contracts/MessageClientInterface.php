<?php

namespace App\Containers\Messagebus\Contracts;

use Interop\Queue\PsrProcessor;

/**
 * Interface MessageClientInterface
 * @package App\Containers\Messagebus\Contracts
 */
interface MessageClientInterface
{
    const DEFAULT_APPLICATION_ID = 'core';

    /**
     * @param string $name
     * @param PsrProcessor|callable $processor
     */
    public function subscribe(string $name, $processor): void;

    /**
     * @param string $key
     * @param string|array $message
     * @param string $applicationId
     */
    public function send(string $key, $message, string $applicationId = 'core'): void;

    /**
     * @param int $timeout
     */
    public function consume(int $timeout = 5): void;
}
