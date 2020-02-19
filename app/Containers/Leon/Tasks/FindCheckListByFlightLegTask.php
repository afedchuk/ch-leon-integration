<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\ChecklistFlight;
use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Ship\Parents\Tasks\Task;

class FindCheckListByFlightLegTask extends Task
{
    /**
     * @var LeonGatewayInterface
     */
    private $gateway;

    /**
     * @var \JsonMapper
     */
    private $mapper;

    public function __construct(LeonGatewayInterface $gateway, \JsonMapper $mapper)
    {
        $this->gateway = $gateway;
        $this->mapper  = $mapper;

        $this->mapper->bEnforceMapType = false;
    }

    public function run(FlightLeg $flightLeg)
    {
        $response = $this->gateway->findCheckListByFlightLeg($flightLeg);

        return $this->mapper->map(
            $response->getResult(), new ChecklistFlight()
        );
    }
}
