<?php

namespace App\Containers\BookingFollow\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BookingFollow\Jobs\GetAndProcessBookingUpdatesJob;
use App\Ship\Parents\Commands\ConsoleCommand;

class CheckBookingUpdatesCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check booking updates.';

    /**
     * CheckBookingUpdatesCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $bookingsFollow = Apiato::call('BookingFollow@GetAllRelevantBookingFollowsAction');

        foreach ($bookingsFollow as $bookingFollow) {
            dispatch(new GetAndProcessBookingUpdatesJob($bookingFollow));
        }
    }
}
