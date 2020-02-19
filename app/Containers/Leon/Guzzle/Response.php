<?php

namespace App\Containers\Leon\Guzzle;

/**
 * Class Response
 * @package App\Containers\Leon\Guzzle
 */
final class Response
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var mixed
     */
    private $body;

    /**
     * @var bool
     */
    private $connectionFailed;

    /**
     * Constructor.
     * @param int $statusCode
     */
    public function __construct(int $statusCode)
    {
        $this->statusCode       = $statusCode;
        $this->connectionFailed = false;
        $this->headers          = [];
    }

    /**
     * @return Response
     */
    public static function buildConnectionFailedResponse()
    {
        $response                   = new self(
            \Symfony\Component\HttpFoundation\Response::HTTP_SERVICE_UNAVAILABLE
        );
        $response->connectionFailed = true;

        return $response;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getHeader(string $name)
    {
        $header = isset($this->headers[$name]) ? $this->headers[$name] : null;

        if (null !== $header && is_array($header)) {
            return $header[0];
        }

        return $header;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        $body = $this->getBody();

        return $body['result'] ?? null;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        $body = $this->getBody();

        return isset($body['result']);
    }

    /**
     * @return bool
     */
    public function isConnectionFailed()
    {
        return $this->connectionFailed;
    }
}
