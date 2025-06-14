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
        //protected bool $mixedBreed,
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
            //'mixedBreed' => $this->mixedBreed,
            'biography' => $this->biography ?? null,
            'farewell' => $this->farewell ?? null,
            'photo' => $this->photo ?? null
        ];
    }

    public function fromArray(array $data) : self
    {
        $pet = new self();
        $pet->userID = $data['userID'];
        $pet->name = $data['name'];
        $pet->type = $data['type'];
        $pet->breed = $data['breed'];
        $pet->birthDate = $data['birthDate'];
        $pet->deathDate = $data['deathDate'];
        //$pet->mixedBreed = $data['isMixedBreed'];
        $pet->biography = $data['biography'] ?? null;
        $pet->farewell = $data['farewell'] ?? null;
        $pet->photo = $data['photoPath'] ?? null;
        return $pet;
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