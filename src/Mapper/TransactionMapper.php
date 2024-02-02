<?php

namespace Shopi\Mapper;

use Shopi\Domain\Order;
use Shopi\Domain\Transaction;
use Shopi\Domain\User;

class TransactionMapper
{
    public static function toEntity(
        Order $order,
        User  $user,
        int   $price,
        ?int  $id = null,
    ): Transaction
    {
        return new Transaction(
            $order,
            $user,
            $price,
            $id
        );
    }
}