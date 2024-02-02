<?php

namespace Shopi\Mapper;

use Shopi\Domain\Product;

class ProductMapper
{
    public static function toEntity(
        string $title,
        int    $price,
        int    $quantity,
        ?int   $id = null,
    ): Product
    {
        return new Product($title, $price, $quantity, $id);
    }
}