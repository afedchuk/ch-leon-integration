<?php

namespace App\Ship\Loggers\Processors;

use Illuminate\Support\Facades\Config;

class EnvironmentProcessor
{
    private static $environment;

    public function __construct()
    {
        self::$environment = Config::get('app.env');
    }

    public function __invoke(array $record): array
    {
        $record['extra']['environment'] = self::$environment;

        return $record;
    }
}
