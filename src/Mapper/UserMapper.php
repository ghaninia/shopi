<?php

namespace Shopi\Mapper;

use Shopi\Domain\User;

class UserMapper
{
    public static function toEntity(
        string $name,
        string $mobile,
        int    $credit,
        ?int   $id = null,
    ): User
    {
        return new User(
            $name,
            $mobile,
            $credit,
            $id,
        );
    }
}