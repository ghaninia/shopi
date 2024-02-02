<?php

namespace Shopi\Tests\Units;

use Shopi\Tests\TestCase;
use Shopi\Utils\Notification\Notification;
use Shopi\Utils\Notification\NotifiableInterface;
use Shopi\Utils\Notification\NotificationProvider;

class NotificationTest extends TestCase
{
    public function testDispatchNotifiesUsingProvider()
    {
        $providerMock = \Mockery::mock(NotificationProvider::class);
        $notifiableMock = \Mockery::mock(NotifiableInterface::class);

        $providerMock
            ->shouldReceive('sendSms')
            ->once()
            ->with($notifiableMock, 'Hello, this is a test message.')
            ->andReturn(true);

        $notification = new Notification();
        $notification->addProvider($providerMock);

        $result = $notification->dispatch($notifiableMock, 'Hello, this is a test message.');
        $this->assertTrue($result);
    }

    public function testDispatchReturnsFalseOnFailure()
    {
        $providerMock = \Mockery::mock(NotificationProvider::class);
        $notifiableMock = \Mockery::mock(NotifiableInterface::class);

        $providerMock
            ->shouldReceive('sendSms')
            ->once()
            ->with($notifiableMock, 'Hello, this is a test message.')
            ->andReturn(false);

        $notification = new Notification();
        $notification->addProvider($providerMock);

        $result = $notification->dispatch($notifiableMock, 'Hello, this is a test message.');
        $this->assertFalse($result);
    }
}