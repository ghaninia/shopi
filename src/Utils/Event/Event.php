<?php

namespace Shopi\Utils\Event;

use Monolog\Logger;
use Shopi\Events\OrderPaidEvent;
use Shopi\Events\SendNotificationListener;

class Event
{

    /**
     * @var array[]
     */
    public $registered = [
        OrderPaidEvent::class => [
            SendNotificationListener::class,
        ]
    ];

    public function __construct(protected Logger $logger)
    {

    }

    /**
     * @param EventInterface $event
     * @return void
     */
    public function dispatch(EventInterface $event)
    {

        $eventClass = get_class($event);

        $eventIsRegistered = isset($this->registered[$eventClass]) && is_array($this->registered[$eventClass]);

        if (!$eventIsRegistered) return;

        $listeners = $this->registered[$eventClass];

        foreach ($listeners as $listener) {

            $listener = new $listener($this->logger);

            if ($listener instanceof BaseListener) {
                $listener->dispatch($event);
            }
        }

    }
}