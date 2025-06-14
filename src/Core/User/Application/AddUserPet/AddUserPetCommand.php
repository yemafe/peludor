<?php

namespace Peludors\Core\User\Application\AddUserPet;

class AddUserPetCommand
{
    public function __construct(
        private int $userID,
        private string $name,
        private string $type,
        private string $breed,
        private int $birthDate,
        private int $deathDate,
        private bool $mixedBreed,
        private string $biography,
        private string $farewell,
        private ?string $photoPath
    ) {
    }
}