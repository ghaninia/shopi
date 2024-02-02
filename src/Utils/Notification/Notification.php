<?php

namespace Shopi\Utils\Notification;

use Monolog\Logger;

class Notification
{
    private Logger $logger;

    /**
     * @param Logger $logger
     * @return $this
     */
    public function setLogger(Logger $logger): self
    {
        $this->logger = $logger;
        return $this;
    }


    /**
     * @var NotificationProvider[]
     */
    private array $providers = [];

    /**
     * @param NotificationProvider $provider
     * @return $this
     */
    public function addProvider(NotificationProvider $provider): self
    {
        $this->providers[] = $provider;
        return $this;
    }

    /**
     * @param NotifiableInterface $notifiable
     * @param string $text
     * @return bool
     */
    public function dispatch(NotifiableInterface $notifiable, string $text): bool
    {
        foreach ($this->providers as $provider) {
            if ($provider->sendSms($notifiable, $text)) {
                if (isset($this->logger)) {
                    $this->logger->info("the text message has been sent successfully", [
                        'provider' => (new \ReflectionClass($provider))->getShortName(),
                        'notifiable' => $notifiable->receiveSMSNumber(),
                        'message' => $text
                    ]);
                }
                return true;
            }
        }
        return false;
    }

}