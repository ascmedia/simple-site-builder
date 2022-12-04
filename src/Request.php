<?php

namespace ASCMedia\SimpleSiteBuilder;

class Request
{
    public const METHOD_GET  = 'GET';
    public const METHOD_POST = 'POST';

    private string $method;

    private string $uri;

    private string $referer;

    private array $cookieParams;

    private array $filesParams;

    private array $getParams;

    private array $postParams;

    private array $requestParams;

    private array $serverParams;

    private array $sessionParams;

    public function __construct()
    {
        $this->setParams();
        $this->uri     = $this->server('REQUEST_URI');
        $this->method  = $this->server('REQUEST_METHOD');
        $this->referer = $this->server('HTTP_REFERER');
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function cookie(string $key): ?string
    {
        return $this->cookieParams[$key];
    }

    public function files(string $key): ?array
    {
        return $this->filesParams[$key];
    }

    public function get(string $key): ?string
    {
        return $this->getParams[$key];
    }

    public function post(string $key): ?string
    {
        return $this->postParams[$key];
    }

    public function request(string $key): ?string
    {
        return $this->requestParams[$key];
    }

    public function server(string $key): ?string
    {
        return $this->serverParams[$key];
    }

    public function session(string $key): ?string
    {
        return $this->sessionParams[$key];
    }

    public function getFiles(): array
    {
        return $this->filesParams;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getReferer(): string
    {
        return $this->referer;
    }

    private function setParams(): self
    {
        $this->cookieParams  = $_COOKIE;
        $this->filesParams   = $_FILES;
        $this->getParams     = $_GET;
        $this->postParams    = $_POST;
        $this->requestParams = $_REQUEST;
        $this->serverParams  = $_SERVER;
        $this->sessionParams = $_SESSION;
        return $this;
    }
}
