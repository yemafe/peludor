<?php

namespace Peludors\UserAdmin\Pet\Infrastructure\Repositories;

use Peludors\UserAdmin\Pet\Domain\Pet;
use Peludors\UserAdmin\Pet\Domain\PetCollection;
use Peludors\UserAdmin\Pet\Domain\PetRepository;
use Peludors\UserAdmin\Pet\Infrastructure\Models\PetModel;
use Illuminate\Database\Capsule\Manager as DB;

class PetMySQLRepository implements PetRepository
{
    public function add(Pet $pet): void
    {
        PetModel::create($pet->toArray());
    }

    public function updateByEntity(Pet $pet): void
    {
        PetModel::update($pet->toArray());
    }

    /*public function getAllOrderedByDeadDate(): PetCollection
    {
        $rows = DB::table('pet')->orderBy('deadDate', 'desc')->get();
        return PetCollection::fromRows($rows);    }
    */
    public function getByUserID(int $userID): PetCollection
    {
        $rows = DB::table('pet')->where('userID', $userID)->get();
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