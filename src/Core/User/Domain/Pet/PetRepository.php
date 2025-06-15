<?php

namespace Peludors\Core\User\Domain\Pet;

use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Domain\PetCollection;

interface PetRepository
{
    public function add(Pet $pet): void;

    public function updateByEntity(Pet $pet): void;

    public function getByUserIDAndName(int $userID, string $name): Pet;


}