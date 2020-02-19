<?php

namespace App\Ship\Loggers;

use App\Ship\Loggers\Processors\EnvironmentProcessor;
use App\Ship\Loggers\Processors\RemoveAuthCredentialsProcessor;
use Gelf\Publisher;
use Gelf\Transport\IgnoreErrorTransportWrapper;
use Gelf\Transport\UdpTransport;
use Monolog\Formatter\GelfMessageFormatter;
use Monolog\Handler\GelfHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;

class GraylogLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger($config['name']);

        // We need a transport - UDP via port 12201 is standard.
        $transport = new UdpTransport(
            $config['host'],
            $config['port'],
            UdpTransport::CHUNK_SIZE_LAN
        );

        if ($config['ignore_error_transport']) {
            $transport = new IgnoreErrorTransportWrapper($transport);
        }

        $publisher = new Publisher();
        $publisher->addTransport($transport);

        $handler = new GelfHandler($publisher);
        $handler->setFormatter(new GelfMessageFormatter());

        $handler->pushProcessor(new WebProcessor());
        $handler->pushProcessor(new MemoryUsageProcessor());
        $handler->pushProcessor(new MemoryPeakUsageProcessor());
        $handler->pushProcessor(new PsrLogMessageProcessor());
        $handler->pushProcessor(new UidProcessor());
        $handler->pushProcessor(new EnvironmentProcessor());
        $handler->pushProcessor(new RemoveAuthCredentialsProcessor());

        $logger->pushHandler($handler);

        return $logger;
    }
}
