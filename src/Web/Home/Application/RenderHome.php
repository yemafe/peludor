<?php

namespace Peludors\Web\Home\Application;

use Peludors\Core\Pet\Domain\PetRepository;

readonly class RenderHome
{
    public function __construct(
        private PetRepository $petRepository
    ){
    }

    public function __invoke(): array
    {
        $latestTributes = $this->petRepository->getThreeLatest();
        $featuredTributes = $this->petRepository->getFeaturedTributes();
        $nextCommemorations = $this->petRepository->getForNextCommemoration();

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

        return [
            'latestTributes' => $latestPetsFormatted, // probando
            'featuredTributes' => $featuredTributes,
            'nextCommemorations' => $nextCommemorations
        ];
    }
}