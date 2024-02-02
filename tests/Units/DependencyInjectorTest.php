<?php

namespace Shopi\Tests\Units;

use Shopi\Exceptions\NotFoundException;
use Shopi\Tests\TestCase;
use Shopi\Utils\DependencyInjector;

class DependencyInjectorTest extends TestCase
{
    public function testSetAndGet()
    {
        $injector = new DependencyInjector();

        $object = new \stdClass();
        $injector->set('example', $object);

        $this->assertSame($object, $injector->get('example'));
    }

    public function testGetThrowsExceptionForUndefinedDependency()
    {
        $this->expectException(NotFoundException::class);

        $injector = new DependencyInjector();
        $injector->get('undefined_dependency');
    }
}
