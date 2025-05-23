<?php

namespace Peludors\Core\User\Infrastructure\Repository;
use Peludors\Core\User\Domain\User;
use Peludors\Core\User\Domain\UserRepository;
use Peludors\Core\User\Infrastructure\Models\UserModel;

class UserMySQLRepository implements UserRepository
{
    public function findByID(int $id): ?User
    {
        $record = UserModel::where('id', $id)->first();
        return $record ? new User($record->id, $record->email, (int)$record->createdAt, $record->name) : null;
    }
}