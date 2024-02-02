<?php

namespace Shopi\Resource;

use Shopi\Domain\Product;

class ProductResponse
{
    /**
     * @param Product[] $products
     * @return array
     */
    public static function collection(array $products): array
    {
        $collect = [];
        foreach ($products as $product) {
            $collect[] = self::single($product);
        }
        return $collect;
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function single(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'price' => $product->getPrice(),
            'quantity' => $product->getQuantity(),
        ];
    }
}