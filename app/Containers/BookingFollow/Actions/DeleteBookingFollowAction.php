<?php

namespace App\Containers\BookingFollow\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBookingFollowAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('BookingFollow@DeleteBookingFollowTask', [$request->id]);
    }
}
