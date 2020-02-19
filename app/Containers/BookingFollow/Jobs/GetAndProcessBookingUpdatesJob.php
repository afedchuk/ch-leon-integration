<?php

namespace App\Containers\BookingFollow\Jobs;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BookingFollow\Models\BookingFollow;
use App\Ship\Parents\Jobs\Job;
use Illuminate\Support\Facades\Redis;

/**
 * Class GetAndProcessBookingUpdatesJob
 */
 class GetAndProcessBookingUpdatesJob extends Job
 {
     /**
      * The number of times the job may be attempted.
      *
      * @var int
      */
     public $tries = 1;

     /**
      * The number of seconds the job can run before timing out.
      *
      * @var int
      */
     public $timeout = 160;

     /**
      * @var BookingFollow
      */
     private $bookingFollow;

     public function __construct(BookingFollow $bookingFollow)
     {
        $this->bookingFollow = $bookingFollow;
     }

     public function handle()
     {
         // Run 10 times every 60 seconds
         Redis::throttle(__CLASS__ . '-' . $this->bookingFollow->reference_number)
             ->allow(10)->every(60)->then(function () {

                 Apiato::call('BookingFollow@GetAndProcessBookingUpdatesAction',
                     [
                         $this->bookingFollow->reference_number
                     ]
                 );

             }, function () {
                 // Could not obtain lock...
                 return $this->release(10);
             });
     }
 }
