<?php

namespace App\Containers\Leon\Events;

use App\Containers\Leon\Guzzle\Request;
use App\Containers\Leon\Guzzle\Response;
use App\Ship\Parents\Events\Event;

/**
 * Class ResponseReceivedEvent
 * @package App\Containers\Leon\Events
 */
class ResponseReceivedEvent extends Event
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * ResponseReceivedEvent constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
