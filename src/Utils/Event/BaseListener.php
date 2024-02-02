<?php

namespace Shopi\Utils\Event;

use Monolog\Logger;

abstract class BaseListener {

    public function __construct(protected Logger $logger)
    {

    }

    abstract public function dispatch(EventInterface $event);

}