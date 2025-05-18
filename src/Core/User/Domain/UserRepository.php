<?php

namespace Peludors\Core\User\Domain;

interface UserRepository
{
    public function findByID(int $id): ?User;
}