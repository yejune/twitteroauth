<?php

declare(strict_types=1);

namespace Limepie\TwitterOAuth;

/**
 * The result of the most recent API request.
 *
 * @author Abraham Williams <abraham@abrah.am>
 */
class Response
{
    /** @var null|string API path from the most recent request */
    private ?string $apiPath = null;

    /** @var int HTTP status code from the most recent request */
    private int $httpCode = 0;

    /** @var array HTTP headers from the most recent request */
    private array $headers = [];

    /** @var null|array|object Response body from the most recent request */
    private null|array|object $body = [];

    /** @var array HTTP headers from the most recent request that start with X */
    private array $xHeaders = [];

    public function setApiPath(string $apiPath) : void
    {
        $this->apiPath = $apiPath;
    }

    public function getApiPath() : ?string
    {
        return $this->apiPath;
    }

    /**
     * @param array|object $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return array|object|string
     */
    public function getBody()
    {
        return $this->body;
    }

    public function setHttpCode(int $httpCode) : void
    {
        $this->httpCode = $httpCode;
    }

    public function getHttpCode() : int
    {
        return $this->httpCode;
    }

    public function setHeaders(array $headers) : void
    {
        foreach ($headers as $key => $value) {
            if ('x' == \substr($key, 0, 1)) {
                $this->xHeaders[$key] = $value;
            }
        }
        $this->headers = $headers;
    }

    public function getsHeaders() : array
    {
        return $this->headers;
    }

    public function setXHeaders(array $xHeaders = []) : void
    {
        $this->xHeaders = $xHeaders;
    }

    public function getXHeaders() : array
    {
        return $this->xHeaders;
    }
}
