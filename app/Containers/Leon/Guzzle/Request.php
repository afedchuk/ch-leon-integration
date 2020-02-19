<?php

namespace App\Containers\Leon\Guzzle;

/**
 * Class Request
 * @package App\Containers\Leon\Guzzle
 */
final class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var mixed
     */
    private $params;

    /**
     * @var string
     */
    private $name;

    /**
     * Request constructor.
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param string $name
     */
    public function __construct(string $method, string $uri, array $headers = [], string $name = '')
    {
        $this->method = $method;
        $this->uri    = $uri;
        $this->name   = $name;

        $this->setHeaders($this->getDefaultHeaders());
        $this->addHeaders($headers);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param array $headers
     */
    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    private function getDefaultHeaders(): array
    {
        return [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Cache-Control' => 'no-cache',
        ];
    }
}
