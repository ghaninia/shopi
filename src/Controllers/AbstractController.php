<?php

namespace Shopi\Controllers;

use Medoo\Medoo;
use Monolog\Logger;
use Shopi\Core\Config;
use Shopi\Core\Request;
use Shopi\Utils\DependencyInjector;

abstract class AbstractController
{
    protected Medoo $db;
    protected Logger $log;
    protected Request $request;
    protected Config $config;
    protected $di;

    public function __construct(DependencyInjector $di, Request $request)
    {
        $this->request = $request;
        $this->di = $di;
        $this->db = $di->get('PDO');
        $this->config = $di->get('Utils\Config');
        $this->log = $di->get('Logger');
    }

}