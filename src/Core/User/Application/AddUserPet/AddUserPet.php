<?php

namespace Peludors\Core\User\Application\AddUserPet;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Peludors\Core\Pet\Domain\Pet;
use Peludors\Core\User\Domain\Pet\PetRepository;

class AddUserPet
{
    public function __construct(
        protected PetRepository $petRepository
    ) {
    }

    public function __invoke(AddUserPetCommand $command): string
    {
        $petName = $command->name();
        try {
            $this->petRepository->getByUserIDAndName($command->userID(), $petName);
            return 'Ya tienes una mascota con el nombre ' . $petName;
        }catch (ModelNotFoundException $exception) {
            $pet = Pet::fromArray([
                'userID' => $command->userID(),
                'name' => $petName,
                'type' => $command->type(),
                'breed' => $command->breed(),
                'birthDate' => $command->birthDate(),
                'deathDate' => $command->deathDate(),
                'mixedBreed' => $command->mixedBreed(),
                'biography' => $command->biography(),
                'farewell' => $command->farewell(),
                'photo' => $command->photopath()
            ]);
            $this->petRepository->add($pet);
            return "Pet created sucessfully.";
        }
    }
}