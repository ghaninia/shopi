<?php

namespace Shopi\Core;


class Request
{

    const POST = "POST";
    const DELETE = "DELETE";
    const GET = "GET";

    private $domain;
    private $path;
    private $method;
    private $params;
    private $cookies;
    private $headers;

    public function __construct()
    {

        $this->domain = $_SERVER['HTTP_HOST'];
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $requestBody = @file_get_contents('php://input');
        $requestBody = json_decode($requestBody, true) ?? [];

        $this->params = new FilteredMap(array_merge($_GET, $_POST, $_REQUEST, $requestBody));

        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->cookies = new FilteredMap($_COOKIE);
        if (function_exists('getallheaders')) {
            $this->headers = new FilteredMap(getallheaders());
        }
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParams(): FilteredMap
    {
        return $this->params;
    }

    public function getHeaders(): FilteredMap
    {
        return $this->headers;
    }
}