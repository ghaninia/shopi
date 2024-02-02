<?php

namespace Shopi\Mapper;

use Shopi\Domain\Order;
use Shopi\Domain\User;

class OrderMapper
{
    public static function toEntity(
         User   $user,
         int    $totalPrice,
         string $status,
         int    $sku,
         ?int   $id = null,
    ): Order
    {
        return new Order(
            $user,
            $totalPrice,
            $status,
            $sku,
            $id,
        );
    }
}