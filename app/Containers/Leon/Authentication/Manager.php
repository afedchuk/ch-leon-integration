<?php

namespace App\Containers\Leon\Authentication;

use App\Containers\Leon\Contracts\RequestHandlerInterface;
use App\Containers\Leon\Exceptions\AuthenticationException;
use App\Containers\Leon\Guzzle\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

/**
 * Class Manager
 * @package App\Containers\Leon\Authentication
 */
class Manager
{
    /**
     * @var UserCredentials
     */
    private $userCredentials;

    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    /**
     * Manager constructor.
     * @param UserCredentials $userCredentials
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(
        UserCredentials $userCredentials,
        RequestHandlerInterface $requestHandler
    ) {
        $this->userCredentials = $userCredentials;
        $this->requestHandler  = $requestHandler;
    }

    /**
     * @return UserCredentials
     */
    public function getUserCredentials(): UserCredentials
    {
        return $this->userCredentials;
    }


    /**
     * @return string
     */
    private function getUrlAuthentication(): string
    {
        return sprintf(
            "%s/",
            Config::get("leon-container.api_url")
        );
    }

    /**
     * @return \App\Containers\Leon\Guzzle\Response
     */
    public function authenticate()
    {
        $uri             = $this->getUrlAuthentication();
        $userCredentials = $this->getUserCredentials();

        $bodyParameters = [
            "jsonrpc"  => "2.0",
            "class"    => "AuthSvc",
            "method"   => "login",
            "params"   => [
                $userCredentials->getCode(),
                $userCredentials->getUsername(),
                $userCredentials->getPassword(),
            ],
            "appName"  => "charter_match",
        ];

        $request = new Request('POST', $uri, [], 'authentication');
        $request->setParams($bodyParameters);

        $response = $this->requestHandler->handle($request);

        $body = $response->getBody();

        if (!(bool)$body['result']) {
            throw new AuthenticationException();
        }

        return $response;
    }
}
