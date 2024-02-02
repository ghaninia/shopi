<?php

namespace Shopi\Tests\Units;

use Shopi\Core\Request;
use Shopi\Core\Router;
use Shopi\Tests\TestCase;
use Shopi\Utils\DependencyInjector;

class YourClass
{
    public function yourMethod()
    {
        
    }
}

class RouterTest extends TestCase
{

    public function testGetRegexRouteReplacesParamsInRoute()
    {
        $router = new Router(new DependencyInjector());

        $route = '/example/:id/:name';
        $info = ['params' => ['id' => 'number', 'name' => 'string']];

        $reflection = new \ReflectionClass(Router::class);
        $method = $reflection->getMethod('getRegexRoute');
        $method->setAccessible(true);

        $result = $method->invoke($router, $route, $info);

        $expectedResult = '/example/\d+/\w';
        $this->assertEquals($expectedResult, $result);
    }


    public function testExtractParamsReturnsArrayOfParams()
    {
        $router = new Router(new DependencyInjector());

        $route = 'example/:id/:name';
        $path = '/example/123/John';

        $reflection = new \ReflectionClass(Router::class);
        $method = $reflection->getMethod('extractParams');
        $method->setAccessible(true);

        $result = $method->invoke($router, $route, $path);
        $expectedResult = ['id' => '123', 'name' => 'John'];
        $this->assertEquals($expectedResult, $result);
    }

}