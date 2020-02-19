<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\Aircraft;
use App\Ship\Parents\Tasks\Task;

class FindAircraftByIdTask extends Task
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
        $response = $this->gateway->findAircraftById($id);

        return $this->mapper->map(
            $response->getResult(),
            new Aircraft()
        );
    }
}
