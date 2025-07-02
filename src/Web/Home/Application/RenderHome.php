<?php

namespace Peludors\Web\Home\Application;

use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\Pet\Domain\PetRepository;
use Peludors\Shared\Domain\ValueObject\Date;

readonly class RenderHome
{
    public function __construct(
        private PetRepository $petRepository
    ){
    }

    public function __invoke(): array
    {
        $threeLatestPetTributes = $this->petRepository->getThreeLatest();
        $featuredPetTributes = $this->petRepository->getFeaturedTributes();

        $threeLatestPetTributesFormatted = $this->processTributes($threeLatestPetTributes);
        $featuredPetTributesFormatted = $this->processTributes($featuredPetTributes);

        return [
            'threeLatestPetTributes' => $threeLatestPetTributesFormatted,
            'featuredPetTributes' => $featuredPetTributesFormatted
        ];
    }


    private function processTributes(PetCollection $latestTributes): array
    {
        $latestPetsFormatted = [];
        foreach ($latestTributes as $pet) {
            $latestPetsFormatted[] = [
                'name' => $pet->name(),
                'breed' => $pet->mixedBreed() ? 'mix de ' . $pet->breed() : $pet->breed(),
                'date' => Date::fromTimestamp($pet->birthDate())->__toString() . ' - '. Date::fromTimestamp($pet->deathDate())->__toString(),
                'farewell' => $pet->farewell(),
                'photo' => 'http://localhost/uploads/users/photo/pets/' .  $pet->photo(), //http://localhost:8000/uploads/users/photo/pets/pet_686157ccd7d7d.png ver bien la url
            ];
        }
        return $latestPetsFormatted;
    }
}