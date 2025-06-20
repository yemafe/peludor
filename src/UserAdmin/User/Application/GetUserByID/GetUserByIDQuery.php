<?php

namespace Peludors\UserAdmin\User\Application\GetUserByID;

readonly class GetUserByIDQuery
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
