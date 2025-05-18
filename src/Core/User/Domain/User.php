<?php

namespace Peludors\Core\User\Domain;

class User
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
        protected string $createdAt
    ){
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}