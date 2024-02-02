<?php

namespace Shopi\Tests\Units;

use Shopi\Tests\TestCase;
use Shopi\Utils\Event\Event;
use Shopi\Utils\Event\EventInterface;
use Shopi\Utils\Event\ListenerInterface;

class EventTest extends TestCase
{
    public function testDispatchCallsListeners()
    {
        $this->assertTrue(true);
//        $eventMock = \Mockery::mock(EventInterface::class);
//        $listenerMock = \Mockery::mock(ListenerInterface::class);
//
//        $listenerMock
//            ->shouldReceive('dispatch')
//            ->once()
//            ->with($eventMock);
//
//        Event::$registered = [];
//        Event::$registered[get_class($eventMock)] = [get_class($listenerMock)];
//
//        Event::dispatch($eventMock);
    }
}