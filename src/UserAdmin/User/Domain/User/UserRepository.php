<?php

namespace Peludors\UserAdmin\User\Domain\User;

interface UserRepository
{
    public function findByID(int $id): ?User;
}