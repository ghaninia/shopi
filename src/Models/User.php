<?php

namespace Shopi\Models;

use Shopi\Exceptions\NotFoundException;
use Shopi\Mapper\ProductMapper;
use Shopi\Mapper\UserMapper;

class User extends AbstractModel
{
    /**
     * @param int $userId
     * @return \Shopi\Domain\|\Shopi\Domain\User
     * @throws NotFoundException
     */
    public function getUserById(int $userId)
    {
        $users = $this->db->select("users", '*', [
            'id' => $userId
        ]);

        if (empty($users)) {
            throw new NotFoundException("user not found!");
        }

        return $this->dbToUser($users[0]);
    }

    /**
     * @param int $userId
     * @param int $credit
     * @return void
     */
    public function decreaseCreditUser(int $userId, int $credit): void
    {
        $this->db->update("users", [
            "credit[-]" => $credit
        ], [
            'id' => $userId,
        ]);
    }


    /**
     * @param array $user
     * @return \Shopi\Domain\$user
     */
    private function dbToUser(array $user): \Shopi\Domain\User
    {
        return UserMapper::toEntity(
            $user["name"],
            $user["mobile"],
            $user["credit"],
            $user["id"],
        );
    }

}