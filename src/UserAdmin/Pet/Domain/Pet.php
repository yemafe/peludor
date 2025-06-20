<?php

namespace Peludors\UserAdmin\Pet\Domain;

class Pet
{
    public function __construct(
        protected int $userID,
        protected string $name,
        protected string $type,
        protected ?string $breed,
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
            'userID' => $this->userID,
            'name' => $this->name,
            'type' => $this->type,
            'breed' => $this->breed ?? null,
            'birthDate' => $this->birthDate,
            'deathDate' => $this->deathDate,
            'mixedBreed' => $this->mixedBreed,
            'biography' => $this->biography ?? null,
            'farewell' => $this->farewell ?? null,
            'photo' => $this->photo ?? null
        ];
    }

    static public function fromArray(array $data) : self
    {
        return new self (
            $data['userID'],
            $data['name'],
            $data['type'],
            $data['breed'] ?? null,
            $data['birthDate'],
            $data['deathDate'],
            $data['mixedBreed'] ,
            $data['biography'] ?? null,
            $data['farewell'] ?? null,
            $data['photo'] ?? null
        );
    }

    public function userID(): int
    {
        return $this->userID;
    }
}