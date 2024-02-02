<?php

namespace Shopi\UseCase;

use Medoo\Medoo;
use Shopi\Domain\Product;
use Shopi\Domain\User;

class WalletBalanceHandler extends BaseOrderProcessing implements OrderProcessInterface
{
    private $nextHandler;

    public function setNextHandler(OrderProcessInterface $handler)
    {
        $this->nextHandler = $handler;
    }

    public function handleOrder(User $user, Product $product, int $quantity)
    {
        $totalPrice = $product->getPrice() * $quantity;

        if ($user->getCredit() - $totalPrice < 0) {
            throw new \Exception("it is not possible to register an order due to the lack of wallet balance!");
        }

        (new \Shopi\Models\User($this->db))->decreaseCreditUser($user->getId(), $totalPrice);

        if ($this->nextHandler) {
            $this->nextHandler->handleOrder($user, $product, $quantity);
        }
    }
}