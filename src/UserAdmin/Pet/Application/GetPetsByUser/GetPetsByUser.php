<?php

namespace Peludors\UserAdmin\Pet\Application\GetPetsByUser;

use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\Pet\Domain\PetRepository;

readonly class GetPetsByUser
{
    public function __construct(
        private PetRepository $petRepository
    ){
    }

    public function __invoke(GetPetsByUserQuery $query) : PetCollection
    {
        return $this->petRepository->getByUserID($query->id());
    }
}