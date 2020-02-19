<?php

namespace App\Containers\Leon\Contracts;

use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Containers\Leon\Guzzle\Response;

/**
 * Class VictorGatewayInterface
 * @package App\Containers\Leon\Contracts
 */
interface LeonGatewayInterface
{
    /**
     * @param $id
     * @return Response
     */
    public function findTripIdByTripNumber($id): Response;

    /**
     * @param $id
     * @return Response
     */
    public function findFlightsByTripId($id): Response;

    /**
     * @param $id
     * @return Response
     */
    public function findAircraftById($id): Response;

    /**
     * @param $id
     * @return Response
     */
    public function findCrewByFlightLegId($id): Response;

    /**
     * @param array $ids
     * @return Response
     */
    public function findCrewToolTipByMembersIds(array $ids): Response;

    /**
     * @param FlightLeg $flightLeg
     * @return Response
     */
    public function findCheckListByFlightLeg(FlightLeg $flightLeg): Response;
}
