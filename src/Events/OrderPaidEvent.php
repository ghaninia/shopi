<?php

namespace Shopi\Events;

use Shopi\Domain\User;
use Shopi\Domain\Order;
use Shopi\Utils\Event\EventInterface;

class OrderPaidEvent implements EventInterface
{
    public function __construct(public User $user, public Order $order)
    {
    }

}