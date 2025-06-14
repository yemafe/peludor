<?php

namespace Peludors\Core\Pet\Domain;

class Pet
{
    public function __construct(
        protected int $id,
        protected int $userID,
        protected string $name,
        protected string $type,
        protected string $breed,
        protected int $birthDate,
        protected int $deathDate,
        protected bool $mixedBreed,
        protected ?string $biography,
        protected ?string $farewell,
        protected ?string $photo
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userID' => $this->userID,
            'name' => $this->name,
            'type' => $this->type,
            'breed' => $this->breed,
            'birthDate' => $this->birthDate,
            'deathDate' => $this->deathDate,
            'mixedBreed' => $this->mixedBreed,
            'biography' => $this->biography ?? '',
            'farewell' => $this->farewell ?? '',
            'photo' => $this->photo ?? ''
        ];
    }

    public function userID(): int
    {
        return $this->userID;
    }

    public function id(): int
    {
        return $this->id;
    }
}