<?php

namespace Peludors\Core\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\Pet\Infrastructure\Models\PetModel;
use Peludors\Core\User\Domain\Pet\PetRepository;

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

    public function getByUserID(int $userID): PetCollection
    {
        $rows = DB::table('pet')->where('userID', $userID)->get();
        return PetCollection::fromRows($rows);
    }*/

    public function getByUserIDAndName(int $userID, string $name): Pet
    {
        $petModel = PetModel::where('userID', $userID)
            ->where('name', $name)
            ->firstOrFail();
        return Pet::fromArray($petModel->toArray());
    }

}