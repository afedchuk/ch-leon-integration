<?php

namespace App\Ship\Loggers\Processors;

class RemoveAuthCredentialsProcessor
{
    public function __construct()
    {

    }

    public function __invoke(array $record): array
    {
        if (false !== strpos($record['message'], 'AuthSvc')) {
            $record['message'] = 'Guzzle. Authorization.';
        }

        return $record;
    }
}
