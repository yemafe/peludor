<?php

namespace Peludors\Core\User\Domain\Pet;

use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Domain\PetCollection;

interface PetRepository
{
    public function add(array $data): Pet;

    public function getByID(int $id): Pet;

    public function updateByEntity(Pet $pet): void;

    public function getAllOrderedByDeadDate(): PetCollection;

    public function getByUserID(int $userID): PetCollection;

    public function getByUserIDAndName(int $userID, string $name): Pet;


}