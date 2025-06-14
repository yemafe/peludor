<?php

namespace Peludors\Core\User\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\User\Domain\Pet\PetRepository;

class PetMySQLRepository implements PetRepository
{
    public function add(Pet $pet): void
    {
        Pet::create($pet->toArray());
    }

    public function getByID(int $id): Pet
    {
        return Pet::find($id);
    }

    public function updateByEntity(Pet $pet): void
    {
        $pet->update($pet->toArray());
    }

    public function getAllOrderedByDeadDate(): PetCollection
    {
        $rows = DB::table('pet')->orderBy('deadDate', 'desc')->get();
        return PetCollection::fromRows($rows);    }

    public function getByUserID(int $userID): PetCollection
    {
        $rows = DB::table('pet')->where('userID', $userID)->get();
        return PetCollection::fromRows($rows);
    }


    public function getByUserIDAndName(int $userID, string $name): Pet
    {
        return Pet::where('userID', $userID)
            ->where('name', $name)
            ->first();
    }

}