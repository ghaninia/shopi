<?php

namespace Shopi\Mapper;

use Shopi\Domain\Order;
use Shopi\Domain\OrderItem;
use Shopi\Domain\Product;
use Shopi\Domain\User;

class OrderItemMapper
{
    public static function toEntity(
        Order   $order,
        Product $product,
        int     $totalPrice,
        int     $count,
        ?int    $id = null,
    ): OrderItem
    {
        return new OrderItem(
            $order,
            $product,
            $totalPrice,
            $count,
            $id,
        );
    }
}