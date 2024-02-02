<?php

namespace Shopi\Utils\Notification\Providers;

use Shopi\Utils\Notification\NotifiableInterface;
use Shopi\Utils\Notification\NotificationProvider;

class CompanyC extends NotificationProvider
{
    public function sendSms(NotifiableInterface $notifiable, string $text): bool
    {
        return true;
    }
}