<?php

namespace Shopi\Models;

class Transaction extends AbstractModel
{

    /**
     * @param \Shopi\Domain\Transaction $transaction
     * @return void
     */
    public function create(\Shopi\Domain\Transaction $transaction): void
    {
        $this->db->insert('transactions', [
            'order_id' => $transaction->getOrder()->getId(),
            'user_id' => $transaction->getUser()->getId(),
            'price' => $transaction->getPrice(),
            "created_at" => (new \DateTime())->format("Y-m-d H:i:s")
        ]);
    }
}