<?php

namespace Shopi\Utils\Notification;

abstract class NotificationProvider
{
    abstract public function sendSms(NotifiableInterface $notifiable, string $text): bool;
}