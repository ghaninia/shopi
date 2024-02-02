<?php

namespace Shopi\Domain;

class Order
{
    const STATUS_SUCCEED = "SUCCEED";

    /** @var OrderItem[] */
    private array $orderItems;

    public function __construct(
        protected User   $user,
        protected int    $totalPrice,
        protected string $status,
        protected int    $sku,
        protected ?int   $id = null,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSku(): int
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param OrderItem $item
     * @return $this
     */
    public function addItem(OrderItem $item): self
    {
        $this->orderItems[] = $item;
        return $this;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->orderItems;
    }
}