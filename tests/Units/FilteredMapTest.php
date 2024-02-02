<?php

namespace Shopi\Tests\Units;

use Shopi\Core\FilteredMap;
use Shopi\Tests\TestCase;

class FilteredMapTest extends TestCase
{
    public function testHasMethodReturnsTrueIfKeyExists()
    {
        $baseMap = ['foo' => 'bar', 'baz' => 'qux'];
        $filteredMap = new FilteredMap($baseMap);

        $this->assertTrue($filteredMap->has('foo'));
        $this->assertTrue($filteredMap->has('baz'));
    }

    public function testGetMethodReturnsValueIfKeyExists()
    {
        $baseMap = ['foo' => 'bar', 'baz' => 'qux'];
        $filteredMap = new FilteredMap($baseMap);

        $this->assertEquals('bar', $filteredMap->get('foo'));
        $this->assertEquals('qux', $filteredMap->get('baz'));
    }

    public function testGetMethodReturnsNullIfKeyDoesNotExist()
    {
        $baseMap = ['foo' => 'bar', 'baz' => 'qux'];
        $filteredMap = new FilteredMap($baseMap);

        $this->assertNull($filteredMap->get('nonexistent'));
    }
}
