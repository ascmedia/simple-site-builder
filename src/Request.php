<?php

namespace ASCMedia\SimpleSiteBuilder;

class Request
{
    public const METHOD_GET  = 'GET';
    public const METHOD_POST = 'POST';

    private string $method;

    private string $uri;

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
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function cookie(string $key): ?string
    {
        return array_key_exists($key, $this->cookieParams) ? $this->cookieParams[$key] : null;
    }

    public function files(string $key): ?array
    {
        return array_key_exists($key, $this->filesParams) ? $this->filesParams[$key] : null;
    }

    public function get(string $key): ?string
    {
        return array_key_exists($key, $this->getParams) ? $this->getParams[$key] : null;
    }

    public function post(string $key): ?string
    {
        return array_key_exists($key, $this->postParams) ? $this->postParams[$key] : null;
    }

    public function request(string $key): ?string
    {
        return array_key_exists($key, $this->requestParams) ? $this->requestParams[$key] : null;
    }

    public function server(string $key): ?string
    {
        return array_key_exists($key, $this->serverParams) ? $this->serverParams[$key] : null;
    }

    public function session(string $key): ?string
    {
        return array_key_exists($key, $this->sessionParams) ? $this->sessionParams[$key] : null;
    }

    public function getFiles(): array
    {
        return $this->filesParams;
    }

    public function getUri(): string
    {
        return $this->uri;
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
