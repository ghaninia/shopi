<?php

namespace Shopi\Domain;

class OrderItem
{
    public function __construct(
        protected Order   $order,
        protected Product $product,
        protected int     $totalPrice,
        protected int     $count,
        protected ?int    $id = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
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
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }


}