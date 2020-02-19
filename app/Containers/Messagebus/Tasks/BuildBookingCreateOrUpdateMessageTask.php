<?php

namespace App\Containers\Messagebus\Tasks;

use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class BuildBookingCreateOrUpdateMessageTask extends Task
{
    public function run(string $referenceNumber, Collection $flights)
    {
        $data = [
            'internalReferenceNumber' => $referenceNumber,
            'referenceNumber'         => $referenceNumber,
            'source'                  => Config::get('messagebus-container.application_id'),
            'sourceType'              => 'OPERATOR',
            'customer'                => null,
            'extra'                   => [
                'relatedOrganizationName' => null,
                'serviceOffice'           => null,
                'notes'                   => null,
            ],
        ];

        $legs = new Collection();
        /** @var FlightLeg $flight */
        foreach ($flights as $flight) {
            $schedule  = $flight->getSchedule();
            $checklist = $flight->getChecklist();

            $leg = collect([
                'internalId'         => $flight->getNid(),
                'expectedPassengers' => $flight->getPaxNumber(),
                'passengers'         => [],
                'aircraft'           => [
                    'aircraftInternalId' => $schedule->getAircraftStruct()->getAcftNid(),
                    'tailNumber'         => $schedule->getAircraftStruct()->getRegistration(),
                    'type'               => $schedule->getAircraftStruct()->getAcftTypeId(),
                    'seats'              => $schedule->getAircraftStruct()->getMaxPaxNumber(),
                ],
                'arrival'            => [
                    'airport'  => [
                        'name'    => $schedule->getAdes()->getName(),
                        'icao'    => $schedule->getAdes()->getIcao(),
                        'iata'    => $schedule->getAdes()->getIata(),
                        'country' => null,
                        'city'    => $schedule->getAdes()->getCity(),
                    ],
                    'dateTime' => $schedule->getDate()->toIso8601ZuluString(),
                    'services' => [
                        'HANDLING'       => [
                            'serviceType' => 'HANDLING',
                            'status'      => strtoupper(
                                optional($checklist->getArrivalHandling())->getStatusDescription()
                            ),
                            'time'        => null,
                            'attributes'  => [
                                'agent' => optional($checklist->getArrivalHandling()->getHandlingAgent())->getName(),
                                'items' => optional($checklist->getArrivalHandling())->getRequestedItems(),
                                'notes' =>  optional($checklist->getArrivalHandling())->getNotes(),
                            ],
                        ],
                        'PERMITS'        => [
                            'serviceType' => 'PERMITS',
                            'status'      => strtoupper(
                                optional($checklist->getArrivalPermits())->getStatusDescription()
                            ),
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'SLOT'           => [
                            'serviceType' => 'SLOT',
                            'status'      => strtoupper(
                                optional($checklist->getArrivalSlot())->getStatusDescription()
                            ),
                            'time'        => optional($checklist->getArrivalSlot())->getTime(),
                            'attributes'  => new \stdClass(),
                        ],
                        'CATERING'       => [
                            'serviceType' => 'CATERING',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'TRANSPORTATION' => [
                            'serviceType' => 'TRANSPORTATION',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'EXTRAS'         => [
                            'serviceType' => 'EXTRAS',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                    ],
                ],
                'departure'          => [
                    'airport'  => [
                        'name'    => $schedule->getAdep()->getName(),
                        'icao'    => $schedule->getAdep()->getIcao(),
                        'iata'    => $schedule->getAdep()->getIata(),
                        'country' => null,
                        'city'    => $schedule->getAdep()->getCity(),
                    ],
                    'dateTime' => $schedule->getDate()->toIso8601ZuluString(),
                    'services' => [
                        'HANDLING'       => [
                            'serviceType' => 'HANDLING',
                            'status'      => strtoupper(
                                optional($checklist->getDepartureHandling())->getStatusDescription()
                            ),
                            'time'        => null,
                            'attributes'  => [
                                'agent' => optional($checklist->getDepartureHandling()->getHandlingAgent())->getName(),
                                'items' => optional($checklist->getDepartureHandling())->getRequestedItems(),
                                'notes' =>  optional($checklist->getDepartureHandling())->getNotes(),
                            ],
                        ],
                        'PERMITS'        => [
                            'serviceType' => 'PERMITS',
                            'status'      => strtoupper(
                                optional($checklist->getDeparturePermits())->getStatusDescription()
                            ),
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'SLOT'           => [
                            'serviceType' => 'SLOT',
                            'status'      => strtoupper(
                                optional($checklist->getDepartureSlot())->getStatusDescription()
                            ),
                            'time'        => optional($checklist->getDepartureSlot())->getTime(),
                            'attributes'  => new \stdClass(),
                        ],
                        'CATERING'       => [
                            'serviceType' => 'CATERING',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'TRANSPORTATION' => [
                            'serviceType' => 'TRANSPORTATION',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                        'EXTRAS'         => [
                            'serviceType' => 'EXTRAS',
                            'status'      => null,
                            'time'        => null,
                            'attributes'  => new \stdClass(),
                        ],
                    ],
                ],
            ]);

            $crew = new Collection();
            foreach ($flight->getCrew() as $member) {
                $m = collect([
                    'internalId' => $member->getPerson()->getNid(),
                    'rank'                 => $member->getPosition()->getName(),
                    'position'             => $member->getPosition()->getPosType(),
                    'fullName'             => $member->getPerson()->getKnownAs(),
                    'phone'                => sprintf(
                        "%s/%s",
                        optional($member->getPhone())->getWorkPhone(),
                        optional($member->getPhone())->getPrivatePhone()
                    ),
                ]);

                $crew->push($m);
            }

            $leg->put('crew', $crew);

            $legs->push($leg);
        }

        return array_merge($data, ['legs' => $legs->toArray()]);
    }
}
