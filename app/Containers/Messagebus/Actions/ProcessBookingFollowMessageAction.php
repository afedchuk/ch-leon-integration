<?php

namespace App\Containers\Messagebus\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BookingFollow\Jobs\GetAndProcessBookingUpdatesJob;
use App\Containers\Messagebus\Data\Transporters\ProcessBookingFollowMessageTransporter;
use App\Ship\Parents\Actions\Action;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessBookingFollowMessageAction extends Action
{
    public function run(ProcessBookingFollowMessageTransporter $transporter)
    {
        try {
            $trip = Apiato::call('Leon@FindTripIdByTripNumberTask', [$transporter->internalReferenceNumber]);
            if (is_null($trip)) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            Log::info('Booking. Booking follow. Trip ID not found. (Reference number: {reference})', [
                'reference' => $transporter->internalReferenceNumber,
            ]);

            return;
        }

        $followUntil = new Carbon($transporter->followUntil);

        $follow = Apiato::call('BookingFollow@UpdateOrCreateBookingFollowTask', [
            [
                'reference_number' => $transporter->internalReferenceNumber,
            ],
            [
                'follow_until' => $followUntil,
            ]
        ]);

        dispatch(new GetAndProcessBookingUpdatesJob($follow));
    }
}
