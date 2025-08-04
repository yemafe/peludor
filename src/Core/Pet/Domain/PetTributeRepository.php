<?php

namespace Peludors\Core\Pet\Domain;

interface PetTributeRepository
{
    public function add(PetTribute $pet): void;

    public function updateByEntity(PetTribute $pet): void;

    public function getByNameAndUserID(int $userID, string $name): PetTribute;

    public function getByUserID(int $userID): PetTributeCollection;

    public function getThreeLatest(): PetTributeCollection;

    public function getFeaturedTributes(): PetTributeCollection;

}