<?php

namespace App\Ship\Kernels;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;
use Illuminate\Support\Facades\Log;

/**
 * Class ConsoleKernel
 *
 * A.K.A (app/Console/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ConsoleKernel extends LaravelConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // NOTE: your Containers command will all be auto registered for you.
        // Same for the Ship commands who live in the `app/Ship/Commands/` directory.
        // If you have commands living somewhere else then consider registering them manually here.
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            Log::info('Greetings from the scheduler... Time: ' . Carbon::now()->toIso8601ZuluString());
        })
            ->everyMinute();

        $schedule->command('queue:retry all')
            ->everyMinute()
            ->onOneServer();

        $schedule->command('booking:check')
            ->everyFiveMinutes()
            ->onOneServer();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // NOTE: No need to load your Commands manually from here.
        // As they are automatically registered by the Apiato Loader.

        // $this->load(__DIR__.'/Commands');

        require app_path('Ship/Commands/Routes.php');
    }

}
