<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class FindFlightsByTripIdTask extends Task
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

    public function run($id)
    {
        $response = $this->gateway->findFlightsByTripId($id);

        return $this->mapper->mapArray(
            $response->getResult(), new Collection(), FlightLeg::class
        );
    }
}
