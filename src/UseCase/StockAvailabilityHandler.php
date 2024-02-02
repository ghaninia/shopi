<?php

namespace Shopi\UseCase;

use Medoo\Medoo;
use Shopi\Domain\Product;
use Shopi\Domain\User;

class StockAvailabilityHandler extends BaseOrderProcessing implements OrderProcessInterface
{
    private $nextHandler;

    public function setNextHandler(OrderProcessInterface $handler)
    {
        $this->nextHandler = $handler;
    }

    public function handleOrder(User $user, Product $product, int $quantity)
    {
        if ($product->getQuantity() < $quantity) {
            throw new \Exception("purchasing is not feasible when the stock is unavailable!");
        }

        (new \Shopi\Models\Product($this->db))->deductStockProduct($product->getId(), $quantity);

        if ($this->nextHandler) {
            $this->nextHandler->handleOrder($user, $product, $quantity);
        }
    }
}