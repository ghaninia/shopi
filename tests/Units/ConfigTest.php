<?php

namespace Shopi\Tests\Units;

use Shopi\Core\Config;
use Shopi\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testGetReturnsConfigValue()
    {
        $value = Config::getInstance(['key1' => 'value1'])->get('key1');
        $this->assertEquals('value1', $value);
    }
}
