<?php

namespace Shopi\Core;

use Medoo\Medoo;
use Shopi\Core\Config;

class Database
{
    private static $instance;

    public function connect(): Medoo
    {
        $dbConfig = Config::getInstance()->get('database');
        return new Medoo([
            'type' => 'mysql',
            'host' => $dbConfig['address'],
            'database' => $dbConfig['database'],
            'username' => $dbConfig['username'],
            'password' => $dbConfig['password']
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = (new self)->connect();
        }
        return self::$instance;
    }
}