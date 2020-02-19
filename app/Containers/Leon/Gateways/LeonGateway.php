<?php

namespace App\Containers\Leon\Gateways;

use App\Containers\Leon\Contracts\RequestHandlerInterface;
use App\Containers\Leon\Authentication\Manager as AuthManager;
use App\Containers\Leon\Data\Structs\FlightLeg;
use App\Containers\Leon\Exceptions\AuthenticationException;
use App\Containers\Leon\Guzzle\Request;
use App\Containers\Leon\Guzzle\Response;
use App\Containers\Leon\Contracts\LeonGatewayInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class LeonGateway implements LeonGatewayInterface
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var int
     */
    private $operatorId;

    /**
     * @var RequestHandlerInterface
     */
    private $handler;

    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @var Collection
     */
    private $counter;

    /**
     * @var int
     */
    private $maxTries = 3;

    /**
     * LeonGateway constructor.
     * @param RequestHandlerInterface $handler
     * @param AuthManager $authManager
     */
    public function __construct(RequestHandlerInterface $handler, AuthManager $authManager)
    {
        $this->uri        = Config::get('leon-container.api_url') . '/';
        $this->operatorId = Config::get('leon-container.operator_id');

        $this->counter     = new Collection();
        $this->handler     = $handler;
        $this->authManager = $authManager;

        $this->authManager->authenticate();
    }

    /**
     * {@inheritdoc}
     */
    public function findTripIdByTripNumber($id): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "TripSvc",
            "method" => "searchTrip",
            "params" => [
                $this->operatorId,
                $id
            ],
        ], 'find-trip-id-by-trip-number');
    }

    /**
     * {@inheritdoc}
     */
    public function findFlightsByTripId($id): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "FlightsDirectorySvc",
            "method" => "getFlightsByTripNid",
            "params" => [$id],
        ], 'find-flights-by-trip-id');
    }

    /**
     * {@inheritdoc}
     */
    public function findAircraftById($id): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "AircraftSvc",
            "method" => "getAircraftInfo",
            "params" => [$id],
        ], 'find-aircraft-by-id');
    }

    /**
     * {@inheritdoc}
     */
    public function findCrewByFlightLegId($id): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "CrewSvc",
            "method" => "getFlightCrew",
            "params" => [$id],
        ], 'find-crew-by-flight-leg-id');
    }

    /**
     * {@inheritdoc}
     */
    public function findCrewToolTipByMembersIds(array $ids): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "CrewSvc",
            "method" => "getPhoneAndWorkEmail",
            "params" => [$ids],
        ], 'find-crew-tooltip-by-member-ids');
    }

    /**
     * {@inheritdoc}
     */
    public function findCheckListByFlightLeg(FlightLeg $flightLeg): Response
    {
        $method = 'POST';
        $uri    = $this->uri;

        return $this->call($method, $uri, [
            "class"  => "ChecklistSvc",
            "method" => "getChecklist",
            "params" => [
                $flightLeg->getNid(),
                $flightLeg->getOprNid(),
                'all',
            ],
        ], 'find-checklist-by-flight-leg');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param string $name
     * @return Response
     */
    private function call(string $method, string $uri, array $parameters = [], string $name = ''): Response
    {
        if (!$this->counter->has($name)) {
            $this->counter->put($name, 1);
        }

        $default = [
            "jsonrpc" => "2.0",
            "appName" => "charter_match",
        ];

        $request = $this->createRequest($method, $uri, array_merge($default, $parameters), $name);

        try {
            Log::info('Leon Gateway. Making call: {function}. Times: {times}', [
                'function' => $name,
                'times'    => $this->counter->get($name),
            ]);

            return $this->handler->handle($request);
        } catch (AuthenticationException $exception) {
            $this->authManager->authenticate();

            $tries = $this->counter->get($name);

            if ($tries <= $this->maxTries) {
                $this->counter->put($name, ++$tries);
                return $this->call($method, $uri, $parameters, $name);
            }

            throw new AuthenticationException();
        }
    }

    /**
     * Create request object
     *
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param string $name
     * @return Request
     */
    private function createRequest(string $method, string $uri, array $parameters = [], string $name = ''): Request
    {
        $request = new Request(
            $method,
            $uri,
            [],
            $name
        );

        $request->setParams($parameters);

        return $request;
    }
}
