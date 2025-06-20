<?php

namespace Peludors\UserAdmin\Pet\Application\AddUserPet;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Peludors\UserAdmin\Pet\Domain\Pet;
use Peludors\UserAdmin\Pet\Domain\PetRepository;

class AddPet
{
    public function __construct(
        protected PetRepository $petRepository
    ) {
    }

    public function __invoke(AddPetCommand $command): string
    {
        $petName = $command->name();
        try {
            $this->petRepository->getByNameAndUserID($command->userID(), $petName);
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
            return "Mascota registrada correctadamente.";
        }
    }
}