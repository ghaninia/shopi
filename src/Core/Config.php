<?php

namespace Shopi\Core;

use Shopi\Exceptions\NotFoundException;

class Config
{
	private $data;
	private static $instance;

    /**
     * @param array|null $data
     */
	private function __construct(array $data = null) {
        $this->data = $data ?? include __DIR__ . '/config/app.php';
	}

    /**
     * @throws NotFoundException
     */
    public function get($key) {
		if (!isset($this->data[$key])) {
			throw new NotFoundException("Key {$key} not found");
		}
		return $this->data[$key];
	}

	public static function getInstance(array $data = null) {
		if (self::$instance == null){
			self::$instance = new Config($data);
		}
		return self::$instance;
	}
}