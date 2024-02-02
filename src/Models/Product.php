<?php

namespace Shopi\Models;

use Shopi\Exceptions\NotFoundException;
use Shopi\Mapper\ProductMapper;

class Product extends AbstractModel
{

    /**
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function deductStockProduct(int $productId, int $quantity)
    {
        $this->db->update("products", [
            "quantity[-]" => $quantity
        ], [
            'id' => $productId,
        ]);
    }
    
    /**
     * @param int $productId
     * @return \Shopi\Domain\Product
     * @throws NotFoundException
     */
    public function getProductById(int $productId)
    {
        $products = $this->db->select("products", '*', [
            'id' => $productId
        ]);

        if (empty($products)) {
            throw new NotFoundException("product not found!");
        }

        return $this->dbToProduct($products[0]);
    }

    /**
     * @return \Shopi\Domain\Product[]
     */
    public function list() : array
    {
        return $this->dbToListProducts(
            $this->db->select('products', '*')
        );
    }

    /**
     * @param array $product
     * @return \Shopi\Domain\Product[]
     */
    public function dbToListProducts(array $products): array
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = $this->dbToProduct($product);
        }
        return $result;
    }

    /**
     * @param array $product
     * @return \Shopi\Domain\Product
     */
    private function dbToProduct(array $product): \Shopi\Domain\Product {
        return ProductMapper::toEntity(
            $product["title"] ?? '',
                $product["price"] ?? 0,
                $product["quantity"] ?? 0,
            $product["id"],
        );
    }

}