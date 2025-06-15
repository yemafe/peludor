<?php

namespace Peludors\Core\User\Application\AddUserPet;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\Pet\Infrastructure\Models\PetModel;
use Peludors\Core\User\Domain\Pet\PetRepository;

class AddUserPet
{
    public function __construct(
        protected PetRepository $petRepository
    ) {
    }

    public function __invoke(AddUserPetCommand $command)
    {
        $petName = $command->name();
        try {
            $this->petRepository->getByUserIDAndName($command->userID(), $petName);
            throw new UserPetAlreadyExists('Ya existe una mascota con el nombre ' . $petName . ' para este usuario.');
        }catch (ModelNotFoundException $exception) {
            $pet = Pet::fromArray([
                'userID' => $command->userID(),
                'name' => $petName,
                'type' => $command->type(),
                'breed' => $command->breed(),
                'birthDay' => $command->birthDate(),
                'deathDay' => $command->deathDate(),
                //'mixedBreed' => $command->mixedBreed(),
                'biography' => $command->biography(),
                'farewell' => $command->farewell(),
                'photo' => $command->photopath()
            ]);
            $this->petRepository->add($pet);
        }
    }
}