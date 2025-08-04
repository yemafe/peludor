<?php

namespace Peludors\UserAdmin\Pet\Application\GetPetsTributesByUser;

readonly class GetPetsTributesByUserQuery
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