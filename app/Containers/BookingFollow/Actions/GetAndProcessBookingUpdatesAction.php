<?php

namespace App\Containers\BookingFollow\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Containers\Logging\Loggers\S3Logger;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

/**
 * Class GetAndProcessBookingUpdatesAction
 * @package App\Containers\BookingFollow\Actions
 */
class GetAndProcessBookingUpdatesAction extends Action
{
    public function run($referenceNumber)
    {
        App::make(S3Logger::class)->setReference($referenceNumber);

        Log::info('Booking. Booking updates. Starting... (Reference number: {reference})', [
            'reference' => $referenceNumber,
        ]);

        $tripId = Apiato::call('Leon@FindTripIdByTripNumberTask', [$referenceNumber]);

        if ($tripId === null) {
            Log::info('Booking. Booking updates. Trip ID not found. (Reference number: {reference})', [
                'reference' => $referenceNumber,
            ]);

            return null;
        }

        /** @var Collection $flights */
        $flights = Apiato::call('Leon@FindFlightsByTripIdTask', [$tripId]);

        if ($flights->isEmpty()) {
            Log::info(
                'Booking. Booking updates. Flights not found. (Reference number: {reference}, Trip ID: {trip_id})',
                [
                    'reference' => $referenceNumber,
                    'trip_id'   => $tripId,
                ]
            );

            return null;
        }

        // Aircraft
        $this->processAircraft($flights);
        $this->processCrew($flights);
        $this->processServices($flights);

        // Build a message
        $message = Apiato::call('Messagebus@BuildBookingCreateOrUpdateMessageTask', [
                $referenceNumber,
                $flights
            ]
        );

        Log::info('Booking. Booking updates. Message has been built. (Reference number: {reference})', [
            'reference' => $referenceNumber,
        ]);

        $hasChanges = Apiato::call('BookingHash@CheckIfBookingHasChangesAction', [
            $referenceNumber,
            $message
        ]);

        if ($hasChanges) {
            Apiato::call('Messagebus@SendBookingUpdatesTask', [$message]);

            return null;
        }

        Log::info('Booking. Booking updates. There are no changes. (Reference number: {reference})', [
            'reference' => $referenceNumber,
        ]);
    }

    private function processAircraft(Collection $flights)
    {
        $cache = new Collection();

        /** @var FlightLeg $flight */
        foreach ($flights as $flight) {
            $schedule = $flight->getSchedule();

            if (!$aircraft = $cache->get($schedule->getAcftNid())) {
                $aircraft = Apiato::call('Leon@FindAircraftByIdTask', [$schedule->getAcftNid()]);
                $cache->put($schedule->getAcftNid(), $aircraft);
            }

            $schedule->setAircraftStruct($aircraft);
        }
    }

    private function processCrew(Collection $flights)
    {
        /** @var FlightLeg $flight */
        foreach ($flights as $flight) {
            $crew = Apiato::call('Leon@FindCrewByFlightLegIdTask', [$flight->getNid()]);

            $ids  = $crew->map(function ($member) {
                return $member->getPerson()->getNid();
            });
            $info = Apiato::call('Leon@FindCrewToolTipByMembersIdsTask', [$ids->toArray()]);

            foreach ($crew as $member) {
                $tooltip = $info->first(function ($value) use ($member) {
                    return $value->getLoginNid() === $member->getPerson()->getNid();
                });

                if ($tooltip) {
                    $member->setPhone($tooltip->getPhone());
                }
            }

            $flight->setCrew($crew);
        }
    }

    private function processServices(Collection $flights)
    {
        /** @var FlightLeg $flight */
        foreach ($flights as $flight) {
            $checklist = Apiato::call('Leon@FindCheckListByFlightLegTask', [$flight]);
            $flight->setChecklist($checklist);
        }
    }
}
