<?php

namespace App\Containers\Leon\Contracts;

/**
 * Interface HttpClientInterface
 * @package App\Containers\Leon\Contracts
 */
interface HttpClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array  $parameters
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, string $uri, array $parameters = []);
}
