<?php

namespace Shopi\Models;

use Shopi\Exceptions\NotFoundException;
use Shopi\Mapper\OrderMapper;
use Shopi\Mapper\UserMapper;

class Order extends AbstractModel
{
    /**
     * @param \Shopi\Domain\Order $order
     * @return void
     */
    public function create(\Shopi\Domain\Order $order): \Shopi\Domain\Order
    {

        $this->db->insert("orders", [
            "user_id" => $order->getUser()->getId(),
            "total_price" => $order->getTotalPrice(),
            "status" => $order->getStatus(),
            "sku" => $order->getSku(),
            "created_at" => (new \DateTime())->format("Y-m-d H:i:s")
        ]);

        $orderId = $this->db->id("orders");

        foreach ($order->getItems() as $item) {
            $items[] = [
                'product_id' => $item->getProduct()->getId(),
                'order_id' => $orderId,
                'total_price' => $item->getTotalPrice(),
                'count' => $item->getCount(),
                "created_at" => (new \DateTime())->format("Y-m-d H:i:s")
            ];
        }

        $this->db->insert('order_items', $items ?? []);

        return $this->getOrderById($orderId);
    }


    /**
     * @param int $orderId
     * @return \Shopi\Domain\Order
     * @throws NotFoundException
     */
    public function getOrderById(int $orderId): \Shopi\Domain\Order
    {
        $orders = $this->db->select("orders", ["[>]users" => ["user_id" => "id"]], [
                'user' => [
                    'users.id',
                    'users.name',
                    'users.mobile',
                    'users.credit',
                ],
                'order' => [
                    'orders.id',
                    'orders.user_id',
                    'orders.total_price',
                    'orders.status',
                    'orders.sku',
                ]
            ]
        );

        if (empty($orders)) {
            throw new NotFoundException("orders not found!");
        }

        return $this->dbToOrder($orders[0]['order'], $orders[0]['user']);
    }

    /**
     * @param array $order
     * @param array $user
     * @return \Shopi\Domain\Order
     */
    private function dbToOrder(array $order, array $user): \Shopi\Domain\Order
    {
        return OrderMapper::toEntity(
            UserMapper::toEntity(
                $user["name"],
                $user["mobile"],
                $user["credit"],
                $user["id"],
            ),
            $order["total_price"],
            $order["status"],
            $order["sku"],
            $order["id"],
        );
    }
}