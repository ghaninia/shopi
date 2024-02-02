<?php

use Shopi\Core\Request;
use Shopi\Core\Router;
use Shopi\Core\Config;
use Shopi\Utils\DependencyInjector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$config = Config::getInstance();

$log = new Logger('shopi');
$logFile = $config->get('log');
$log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));

$di = new DependencyInjector;
$di->set('PDO', \Shopi\Core\Database::getInstance());
$di->set('Utils\Config', $config);
$di->set('Logger', $log);

$router = new Router($di);
$router->route(new Request);
