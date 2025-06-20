<?php

namespace Peludors\UserAdmin\User\Domain\User;

class User
{
    public function __construct(
        protected int $id,
        protected string $email,
        protected int $createdAt,
        protected string $name,
        protected ?string $surname = null,
        protected ?string $source = null,
        protected ?string $avatar = null,
        protected ?int $updatedAt = null
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'source' => $this->source,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}
