<?php

namespace Peludors\UserAdmin\Pet\Application\AddTribute;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Peludors\Core\Pet\Domain\PetTribute;
use Peludors\Core\Pet\Domain\PetTributeRepository;

class AddTribute
{
    public function __construct(
        protected PetTributeRepository $petRepository
    ) {
    }

    public function __invoke(AddTributeCommand $command): string
    {
        $petName = $command->name();
        try {
            $this->petRepository->getByNameAndUserID($command->userID(), $petName);
            return 'Ya tienes una mascota con el nombre ' . $petName;
        }catch (ModelNotFoundException $exception) {
            $pet = PetTribute::fromArray([
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