<?php

namespace Peludors\Core\User\Application\AddUserPet;

use AllowDynamicProperties;

#[AllowDynamicProperties] class AddUserPetCommand
{
    public function __construct( array $data )
    {
        $this->userID = (int) $data['userID'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->breed = $data['breed'];
        $this->birthDate = (int) $data['birthDate'];
        $this->deathDate = (int) $data['deathDate'];
        //$this->mixedBreed = (int) $data['mixedBreed'];
        $this->biography = $data['biography'];
        $this->farewell = $data['farewell'];
        $this->photoPath = $data['photoPath'];
    }

    public function userID(): int
    {
        return $this->userID;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function breed(): string
    {
        return $this->breed;
    }

    public function birthDate(): string
    {
        return $this->birthDate;
    }

    public function deathDate(): string
    {
        return $this->deathDate;
    }

    /*public function mixedBreed(): bool
    {
        return $this->mixedBreed;
    }*/

    public function biography(): ?string
    {
        return $this->biography;
    }

    public function farewell(): ?string
    {
        return $this->farewell;
    }

    public function photoPath(): ?string
    {
        return $this->photoPath;
    }
}