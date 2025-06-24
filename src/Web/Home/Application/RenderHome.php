<?php

namespace Peludors\Web\Home\Application;

use Peludors\Core\Pet\Domain\PetRepository;

readonly class RenderHome
{
    public function __construct(
        private PetRepository $petRepository,
    ){
    }

    public function __invoke(): array
    {
        $latestTributes = $this->petRepository->getThreeLatest();
        $featuredTributes = $this->petRepository->getFeaturedTributes();
        $nextCommemorations = $this->petRepository->getForNextCommemoration();

        return [
            'latestTributes' => $this->getThreeLatestTributes,
            'featuredTributes' => $this->getFeaturedTributes,
            'nextCommemorations' => $this->nextCommemorations
        ];
    }
}