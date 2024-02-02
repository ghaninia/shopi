<?php

namespace Shopi\Resource;

const HTTP_OK = 200;
const HTTP_NOT_FOUND = 404;
const HTTP_BAD_REQUEST = 400;
const HTTP_CREATED = 201;

class RestResponse
{
    protected array $payload;
    protected string $message;

    public function __construct(protected int $code)
    {
    }

    public function payload(array $payload): static
    {
        $this->payload = $payload;
        return $this;
    }

    public function message(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    final public function echo()
    {
        $echo = [];
        if (isset($this->payload)) {
            $echo['data'] = $this->payload;
        }
        if (isset($this->message)) {
            $echo['msg'] = $this->message;
        }
        http_response_code($this->code);
        echo json_encode($echo);
        die();
    }
}