<?php

namespace Shopi\UseCase;

use Medoo\Medoo;
use Monolog\Logger;

abstract class BaseOrderProcessing
{
    public function __construct(protected Medoo $db, protected Logger $logger)
    {
    }
}