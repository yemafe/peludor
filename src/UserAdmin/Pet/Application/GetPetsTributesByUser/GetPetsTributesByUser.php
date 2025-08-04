<?php

namespace Peludors\UserAdmin\Pet\Application\GetPetsTributesByUser;

use Peludors\Core\Pet\Domain\PetTributeCollection;
use Peludors\Core\Pet\Domain\PetTributeRepository;

readonly class GetPetsTributesByUser
{
    public function __construct(
        private PetTributeRepository $petRepository
    ){
    }

    public function __invoke(GetPetsTributesByUserQuery $query) : PetTributeCollection
    {
        return $this->petRepository->getByUserID($query->id());
    }
}