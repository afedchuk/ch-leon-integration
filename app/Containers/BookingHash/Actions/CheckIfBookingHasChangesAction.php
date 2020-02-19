<?php

namespace App\Containers\BookingHash\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\SubAction;

class CheckIfBookingHasChangesAction extends SubAction
{
    public function run(string $referenceNumber, array $message)
    {
        $hash        = md5(json_encode($message));
        $bookingHash = Apiato::call('BookingHash@FindBookingHashByReferenceNumberTask', [$referenceNumber]);

        if ($hash !== optional($bookingHash)->hash) {
            Apiato::call('BookingHash@UpdateOrCreateBookingHashTask', [
                ['reference_number' => $referenceNumber],
                ['hash' => $hash],
            ]);

            return true;
        }

        return false;
    }
}
