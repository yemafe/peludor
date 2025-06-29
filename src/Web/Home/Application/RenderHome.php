<?php

namespace Peludors\Web\Home\Application;

use Peludors\Core\Pet\Domain\PetCollection;
use Peludors\Core\Pet\Domain\PetRepository;

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
                'breed' => $pet->breed(), //iconito según typo
                'birthDate' => $pet->birthDate(), //pasar a fecha legible
                'biography' => $pet->biography(),
                'photo' => $pet->photo(),
            ];
        }
        return $latestPetsFormatted;
    }
}