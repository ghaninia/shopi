<?php

namespace Shopi\Utils;

use Shopi\Exceptions\NotFoundException;

class DependencyInjector
{
	private $dependecies = [];

	public function set(string $name, $object) {
		$this->dependecies[$name] = $object;
	}

	public function get(string $name) {
		if (isset($this->dependecies[$name])) {
			return $this->dependecies[$name];
		}
		throw new NotFoundException(
			$name . " dependency not found."
		);
	}
}