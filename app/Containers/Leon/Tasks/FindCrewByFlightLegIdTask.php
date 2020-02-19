<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\CrewMember;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class FindCrewByFlightLegIdTask extends Task
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
        $response = $this->gateway->findCrewByFlightLegId($id);

        return $this->mapper->mapArray(
            $response->getResult(), new Collection(), CrewMember::class
        );
    }
}
