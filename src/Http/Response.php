<?php

namespace App\Http;

class Response
{
    public const int HTTP_OK = 200;
    public const int HTTP_NOT_FOUND = 404;
    public const int HTTP_METHOD_NOT_ALLOWED = 405;
    public const int HTTP_INTERNAL_SERVER_ERROR = 500;

    public function __construct(
        private string $body = '',
        private int $statusCode = 200,
        private iterable $headers = [],
    ){}

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}