<?php

namespace Shopi\Events;

use Shopi\Utils\Event\BaseListener;
use Shopi\Utils\Event\EventInterface;
use Shopi\Utils\Notification\Notification;

use Shopi\Utils\Notification\Providers\CompanyA;
use Shopi\Utils\Notification\Providers\CompanyB;
use Shopi\Utils\Notification\Providers\CompanyC;

class SendNotificationListener extends BaseListener
{
    public function dispatch(EventInterface $event)
    {
        $msg = sprintf("Dear %s; Your order has been successfully placed!", $event->user->getName());
        (new Notification())
            ->setLogger($this->logger)
            ->addProvider(new CompanyA())
            ->addProvider(new CompanyB())
            ->addProvider(new CompanyC())
            ->dispatch($event->user, $msg);
    }
}