<?php

namespace App\Containers\BookingFollow\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindBookingFollowByIdAction extends Action
{
    public function run(Request $request)
    {
        $bookingfollow = Apiato::call('BookingFollow@FindBookingFollowByIdTask', [$request->id]);

        return $bookingfollow;
    }
}
