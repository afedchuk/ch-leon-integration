<?php

namespace App\Containers\Leon\Clients;

use App\Containers\Leon\Contracts\HttpClientInterface;
use App\Ship\Parents\Clients\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Config;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class GuzzleClient
 * @package App\Containers\Leon\HttpClients
 */
class GuzzleClient extends HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());

        $stack->push(
            Middleware::log(
                $this->getLogger(),
                new MessageFormatter(
                    "Guzzle. {req_header_User-Agent} - [{date_common_log}] \"{method} {uri}\" {code} {res_header_Content-Length} {req_body}"
                )
            )
        );
        $stack->push(Middleware::cookies());

        $this->client = new Client([
            'handler'                       => $stack,
            RequestOptions::VERIFY          => false,
            RequestOptions::TIMEOUT         => 30,
            RequestOptions::CONNECT_TIMEOUT => 20,
            RequestOptions::COOKIES => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $method, string $uri, array $parameters = [])
    {
        return $this->client->request($method, $uri, $parameters);
    }

    /**
     * @return mixed
     */
    private function getLogger()
    {
        return app('log')
            ->channel(Config::get('logging.default'));
    }
}
