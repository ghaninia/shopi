<?php

namespace Shopi\UseCase;

use Medoo\Medoo;
use Shopi\Domain\Product;
use Shopi\Domain\User;

interface OrderProcessInterface
{
    public function handleOrder(User $user, Product $product, int $quantity);
}