<?php

namespace Peludors\UserAdmin\Pet\Domain;

interface PetRepository
{
    public function add(Pet $pet): void;

    public function updateByEntity(Pet $pet): void;

    public function getByNameAndUserID(int $userID, string $name): Pet;

    public function getByUserID(int $userID): PetCollection;
}