<?php

namespace App\Containers\BookingFollow\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateBookingFollowAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $bookingfollow = Apiato::call('BookingFollow@UpdateBookingFollowTask', [$request->id, $data]);

        return $bookingfollow;
    }
}
