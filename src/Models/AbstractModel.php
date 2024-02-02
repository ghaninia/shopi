<?php

namespace Shopi\Models;

use Medoo\Medoo;

abstract class AbstractModel {
	public function __construct(public Medoo $db) {
	}
}