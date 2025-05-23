<?php

namespace Peludors\Core\User\Domain;

class User
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $nickName,
        protected string $email,
        protected string $createdAt,
        protected ?string $avatar = null,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
    public function nickName(): string
    {
        return $this->nickName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function avatar(): ?string
    {
        return $this->avatar;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'nickName' => $this->nickName(),
            'email' => $this->email(),
            'avatar' => $this->avatar(),
            'createdAt' => $this->createdAt(),
        ];
    }
}
