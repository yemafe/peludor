<?php

namespace Peludors\Web\Home\Application;

use DateTime;
use Peludors\Core\Pet\Domain\PetTribute;
use Peludors\Core\Pet\Domain\PetTributeCollection;
use Peludors\Core\Pet\Domain\PetTributeRepository;
use Peludors\Shared\Domain\ValueObject\Date;
use Peludors\Shared\Infrastructure\Services\UrlBuilder;
use Carbon\Carbon;

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
            $deathDate = (new DateTime())->setTimestamp((int) $pet->deathDate());
            $birthDate = (new DateTime())->setTimestamp((int) $pet->birthDate());

            $latestPetsFormatted[] = [
                'name' => $pet->name(),
                'breed' => $pet->mixedBreed() ? 'mix de ' . $pet->breed() : $pet->breed(),
                'formattedBirthDate' => $birthDate->format('j F Y'),
                'farewell' => $pet->farewell() ?? $pet->biography(),
                'photoURL' => $this->getPhoto($pet),
                'age' => $this->getAge($birthDate, $deathDate). 'años',
                'formattedDeathDate' => $deathDate->format('j F Y'),
                'type' => $this->getPetTypeIcon($pet->type())
            ];
        }
        return $latestPetsFormatted;
    }

    private function getAge(DateTime $birthDate, DateTime $deathDate): int
    {
        return $birthDate->diff($deathDate)->y;
    }

    private function getPhoto(PetTribute $pet): string
    {
        $hasPhoto = $pet->photo();
        return $hasPhoto ? UrlBuilder::petImage($pet->photo()) : match ($pet->type()) {
            'perro' => UrlBuilder::defaultDogImage(),
            'gato' => UrlBuilder::defaultCatImage(),
            default => UrlBuilder::defaultRodentImage()
        };
    }

    private function getPetTypeIcon(?string $type): string
    {
        $type = strtolower(trim($type ?? ''));

        return match(true) {
            str_contains($type, 'perro') => 'dog',
            str_contains($type, 'gato') => 'cat',
            default => 'other',
        };
    }
}