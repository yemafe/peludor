<?php

namespace Peludors\Core\User\Domain\User;

interface UserRepository
{
    public function findByID(int $id): ?User;
}