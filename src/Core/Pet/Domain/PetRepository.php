<?php

namespace Peludors\Core\Pet\Domain;

interface PetRepository
{
    public function add(Pet $pet): void;

    public function updateByEntity(Pet $pet): void;

    public function getByNameAndUserID(int $userID, string $name): Pet;

    public function getByUserID(int $userID): PetCollection;

    public function getThreeLatest(): PetCollection;

    public function getFeaturedTributes(): PetCollection;

}