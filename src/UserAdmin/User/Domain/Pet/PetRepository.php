<?php

namespace Peludors\UserAdmin\User\Domain\Pet;

use Peludors\UserAdmin\Pet\Domain\Pet;

interface PetRepository
{
    public function add(Pet $pet): void;

    public function updateByEntity(Pet $pet): void;

    public function getByUserIDAndName(int $userID, string $name): Pet;


}