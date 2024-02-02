<?php

namespace Shopi\Domain;

use Shopi\Utils\Notification\NotifiableInterface;

class User implements NotifiableInterface
{
    public function __construct(
        protected string $name,
        protected string $mobile,
        protected int    $credit,
        protected ?int   $id = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function receiveSMSNumber(): string
    {
        return $this->mobile;
    }
}