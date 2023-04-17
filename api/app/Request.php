<?php

namespace App;
class Request
{
    private array $server;
    private array $request;
    private array $get;
    private array $post;

    public function __construct(array $server, array $request, array $get, array $post)
    {
        $this->server = $server;
        $this->request = $request;
        $this->get = $get;
        $this->post = $post;
    }

    public function getUrl(): string
    {
        return stristr($this->server['REQUEST_URI'], '?', true);
    }

    public function server(string $param)
    {
        return $this->server[$param] ?? null;
    }

    public function request(string $param)
    {
        return $this->request[$param] ?? null;
    }

    public function get(string $param)
    {
        return $this->get[$param] ?? null;
    }

    public function post(string $param)
    {
        return $this->post[$param] ?? null;
    }

    public function isGet(): bool
    {
        return $this->server['REQUEST_METHOD'] === 'GET';
    }

    public function isPost(): bool
    {
        return $this->server['REQUEST_METHOD'] === 'POST';
    }
}