<?php

namespace Peludors\UserAdmin\User\Infrastructure\Repository;
use Peludors\UserAdmin\User\Domain\User\User;
use Peludors\UserAdmin\User\Domain\User\UserRepository;
use Peludors\UserAdmin\User\Infrastructure\Models\UserModel;

class UserMySQLRepository implements UserRepository
{
    public function findByID(int $id): ?User
    {
        $record = UserModel::where('id', $id)->first();
        return $record ? new User($record->id, $record->email, (int)$record->createdAt, $record->name) : null;
    }
}