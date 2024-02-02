<?php

namespace Shopi\Utils\Notification;

interface NotifiableInterface
{
    public function receiveSMSNumber(): string;
}