<?php

namespace Shopi\UseCase;

use Shopi\Domain\Product;
use Shopi\Domain\User;
use Shopi\Events\OrderPaidEvent;
use Shopi\Mapper\OrderItemMapper;
use Shopi\Mapper\OrderMapper;
use Shopi\Mapper\TransactionMapper;
use Shopi\Models\Order;
use Shopi\Models\Transaction;
use Shopi\Utils\Event\Event;

class ProcessBaseOrderHandler extends BaseOrderProcessing implements OrderProcessInterface
{
    public function handleOrder(User $user, Product $product, int $quantity)
    {
        $totalPrice = $product->getPrice() * $quantity;

        $entityOrder = OrderMapper::toEntity($user, $totalPrice, \Shopi\Domain\Order::STATUS_SUCCEED, 1);
        $entityOrderItem = OrderItemMapper::toEntity($entityOrder, $product, $totalPrice, $quantity);
        $entityOrder->addItem($entityOrderItem);

        $order = (new Order($this->db))->create($entityOrder);
        (new Transaction($this->db))->create(TransactionMapper::toEntity($order, $user, $totalPrice));

        (new Event($this->logger))->dispatch(new OrderPaidEvent($user, $order));
    }
}