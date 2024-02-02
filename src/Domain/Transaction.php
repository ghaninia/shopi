<?php

namespace Shopi\Domain;

class Transaction
{
    public function __construct(
        protected Order $order,
        protected User  $user,
        protected int   $price,
        protected ?int  $id = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}