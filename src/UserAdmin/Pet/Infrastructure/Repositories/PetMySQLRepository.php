<?php

namespace Peludors\UserAdmin\Pet\Infrastructure\Repositories;

use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\Pet\Domain\PetRepository;
use Peludors\UserAdmin\Pet\Infrastructure\Models\PetModel;

class PetMySQLRepository implements PetRepository
{
    public function add(Pet $pet): void
    {
        PetModel::create($pet->toArray());
    }

    public function updateByEntity(Pet $pet): void
    {
        PetModel::where('id', $pet->id())->update($pet->toArray());
    }

    public function getByUserID(int $userID): PetCollection
    {
        $rows = PetModel::where('userID', $userID)->get();
        return PetCollection::fromRows($rows);
    }

    public function getThreeLatest(): PetCollection
    {
        $rows = PetModel::orderByDesc('id')->limit(3)->get();
        return PetCollection::fromRows($rows);
    }

    public function getFeaturedTributes(): PetCollection
    {
        $rows = PetModel::whereIn('id', [5, 7, 9])->get();
        return PetCollection::fromRows($rows);
    }

    public function getByNameAndUserID(int $userID, string $name): Pet
    {
        $petModel = PetModel::where('userID', $userID)
            ->where('name', $name)
            ->firstOrFail();

        return Pet::fromArray($petModel->toArray());
    }
}
