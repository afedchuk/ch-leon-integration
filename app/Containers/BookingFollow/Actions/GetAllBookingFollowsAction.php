<?php

namespace App\Containers\BookingFollow\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllBookingFollowsAction extends Action
{
    public function run(Request $request)
    {
        $bookingfollows = Apiato::call('BookingFollow@GetAllBookingFollowsTask', [], ['addRequestCriteria']);

        return $bookingfollows;
    }
}
