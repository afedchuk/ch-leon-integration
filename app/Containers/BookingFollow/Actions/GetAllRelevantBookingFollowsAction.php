<?php

namespace App\Containers\BookingFollow\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllRelevantBookingFollowsAction extends Action
{
    public function run()
    {
        $bookingfollows = Apiato::call(
            'BookingFollow@GetAllBookingFollowsTask',
            [],
            [
                'relevant',
            ]
        );

        return $bookingfollows;
    }
}
