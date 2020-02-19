<?php

namespace App\Containers\Leon\Handlers;

use App\Containers\Leon\Contracts\RequestHandlerInterface;
use App\Containers\Leon\Events\ResponseReceivedEvent;
use App\Containers\Leon\Exceptions\AuthenticationException;
use App\Containers\Leon\Exceptions\BadResponseException;
use App\Containers\Leon\Guzzle\Request;
use App\Containers\Leon\Contracts\HttpClientInterface;
use App\Containers\Leon\Guzzle\Response;
use GuzzleHttp\RequestOptions;

/**
 * Class GuzzleRequestHandler
 * @package App\Containers\Leon\Handlers
 */
class LeonRequestHandler implements RequestHandlerInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * Constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return HttpClientInterface
     */
    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        /** @var \GuzzleHttp\Psr7\Response $guzzleResponse */
        $guzzleResponse = $this->request($request);

        $response = new Response($guzzleResponse->getStatusCode());
        $response->setHeaders($guzzleResponse->getHeaders());
        $response->setBody($guzzleResponse->getBody()->__toString());

        event(new ResponseReceivedEvent($request, $response));

        if (!$response->isSuccessful()) {
            $body = $response->getBody();

            if (is_array($body)) {
                $message = $body['error']['message'];
                $code    = $body['error']['code'];
            } else {
                $message = $body;
                $code    = $response->getStatusCode();
            }

            if ($message === 'Not logged in') {
                throw new AuthenticationException();
            }

            throw new BadResponseException($message, null, $code);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return \GuzzleHttp\Psr7\Response
     */
    private function request(Request $request)
    {
        /** @var \GuzzleHttp\Psr7\Response $guzzleResponse */
        $guzzleResponse = $this->client->request(
            $request->getMethod(),
            $request->getUri(),
            [
                RequestOptions::HEADERS => $request->getHeaders(),
                RequestOptions::JSON    => $request->getParams(),
            ]
        );

        return $guzzleResponse;
    }
}
