<?php

namespace Peludors\Web\Home\Application;

use Peludors\Core\Pet\Domain\PetTributeCollection;
use Peludors\Core\Pet\Domain\PetTributeRepository;
use Peludors\Shared\Domain\ValueObject\Date;
use Peludors\Shared\Infrastructure\Services\UrlBuilder;

readonly class RenderHome
{
    public function __construct(
        private PetTributeRepository $petRepository
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


    private function processTributes(PetTributeCollection $latestTributes): array
    {
        $latestPetsFormatted = [];
        foreach ($latestTributes as $pet) {
            $hasPhoto = $pet->photo();
            $photo = $hasPhoto ? UrlBuilder::petImage($pet->photo()) : match ($pet->type()) {
                'perro' => UrlBuilder::defaultDogImage(),
                'gato' => UrlBuilder::defaultCatImage(),
                default => UrlBuilder::defaultRodentImage()
            };

            $latestPetsFormatted[] = [
                'name' => $pet->name(),
                'breed' => $pet->mixedBreed() ? 'mix de ' . $pet->breed() : $pet->breed(),
                'date' => Date::fromTimestamp($pet->birthDate())->__toString() . ' - '. Date::fromTimestamp($pet->deathDate())->__toString(),
                'farewell' => $pet->farewell(),
                'photoURL' => $photo
            ];
        }
        return $latestPetsFormatted;
    }
}