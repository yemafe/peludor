<?php

namespace Peludors\UserAdmin\Pet\Application\GetPetsByUser;

readonly class GetPetsByUserQuery
{
    public function __construct(
        private int $id
    ){
    }

    public function id(): int
    {
        return $this->id;
    }
}