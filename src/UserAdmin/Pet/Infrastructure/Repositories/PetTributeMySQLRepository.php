<?php

namespace Peludors\UserAdmin\Pet\Infrastructure\Repositories;

use Peludors\Core\Pet\Domain\PetTribute;
use Peludors\Core\Pet\Domain\PetTributeCollection;
use Peludors\Core\Pet\Domain\PetTributeRepository;
use Peludors\UserAdmin\Pet\Infrastructure\Models\PetTributeModel;

class PetTributeMySQLRepository implements PetTributeRepository
{
    public function add(PetTribute $pet): void
    {
        PetTributeModel::create($pet->toArray());
    }

    public function updateByEntity(PetTribute $pet): void
    {
        PetTributeModel::where('id', $pet->id())->update($pet->toArray());
    }

    public function getByUserID(int $userID): PetTributeCollection
    {
        $rows = PetTributeModel::where('userID', $userID)->get();
        return PetTributeCollection::fromRows($rows);
    }

    public function getThreeLatest(): PetTributeCollection
    {
        $rows = PetTributeModel::orderByDesc('id')->limit(3)->get();
        return PetTributeCollection::fromRows($rows);
    }

    public function getFeaturedTributes(): PetTributeCollection
    {
        $rows = PetTributeModel::whereIn('id', [5, 7, 9])->get();
        return PetTributeCollection::fromRows($rows);
    }

    public function getByNameAndUserID(int $userID, string $name): PetTribute
    {
        $petModel = PetTributeModel::where('userID', $userID)
            ->where('name', $name)
            ->firstOrFail();

        return PetTribute::fromArray($petModel->toArray());
    }
}
