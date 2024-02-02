<?php

namespace Shopi\Tests\Units;

use Shopi\Domain\Order;
use Shopi\Domain\OrderItem;
use Shopi\Domain\Product;
use Shopi\Domain\User;
use Shopi\Tests\TestCase;

class OrderTest extends TestCase
{
    public function testOrderGetters()
    {
        $user = new User(
            "amin",
            "09114904505",
            50000,
            1
        );
        $totalPrice = 100;
        $status = Order::STATUS_SUCCEED;
        $sku = 12345;

        $order = new Order($user, $totalPrice, $status, $sku);

        $this->assertSame($user, $order->getUser());
        $this->assertEquals($totalPrice, $order->getTotalPrice());
        $this->assertEquals($status, $order->getStatus());
        $this->assertEquals($sku, $order->getSku());
        $this->assertNull($order->getId());
    }

    public function testOrderAddItem()
    {
        $user = new User(
            "amin",
            "09114904505",
            50000
        );
        $totalPrice = 100;
        $status = Order::STATUS_SUCCEED;
        $sku = 12345;
        $order = new Order($user, $totalPrice, $status, $sku);
        $product = new Product(
            "product 1",
            330000,
            20
        );
        $item1 = new OrderItem(
            $order, $product, 5000, 10
        );
        $order->addItem($item1);
        $items = $order->getItems();
        $this->assertCount(1, $items);
        $this->assertSame($item1, $items[0]);
    }
}
