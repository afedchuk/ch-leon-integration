<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\SearchTrip;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class FindTripIdByTripNumberTask extends Task
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
        $response = $this->gateway->findTripIdByTripNumber($id);

        $mapped = $this->mapper->mapArray(
            $response->getResult(), new Collection(), SearchTrip::class
        );

        if ($first = $mapped->first()) {
            return $first->getNid();
        }

        return null;
    }
}
