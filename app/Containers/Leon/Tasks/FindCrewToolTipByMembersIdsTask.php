<?php

namespace App\Containers\Leon\Tasks;

use App\Containers\Leon\Contracts\LeonGatewayInterface;
use App\Containers\Leon\Data\Structs\CrewToolTip;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class FindCrewToolTipByMembersIdsTask extends Task
{
    /**
     * @var LeonGatewayInterface
     */
    private $gateway;

    /**
     * @var \JsonMapper
     */
    private $mapper;

    /**
     * FindCrewToolTipByMembersIdsTask constructor.
     * @param LeonGatewayInterface $gateway
     * @param \JsonMapper $mapper
     */
    public function __construct(LeonGatewayInterface $gateway, \JsonMapper $mapper)
    {
        $this->gateway = $gateway;
        $this->mapper  = $mapper;

        $this->mapper->bEnforceMapType = false;
    }

    public function run(array $id)
    {
        $response = $this->gateway->findCrewToolTipByMembersIds($id);

        return $this->mapper->mapArray(
            $response->getResult(), new Collection(), CrewToolTip::class
        );
    }
}
