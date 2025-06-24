<?php

namespace Peludors\Core\Pet\Domain;

use AllowDynamicProperties;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

#[AllowDynamicProperties] class PetCollection implements IteratorAggregate
{
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->pets);
    }

    public function __construct(array $pets = [])
    {
        $this->pets = $pets;
    }

    public static function fromRows(iterable $rows): self
    {
        $pets = [];

        foreach ($rows as $row) {
            $pets[] = new Pet(
                userID: $row->userID,
                name: $row->name,
                type: $row->type,
                breed: $row->breed,
                birthDate: $row->birthDate,
                deathDate: $row->deathDate,
                mixedBreed: $row->mixedBreed,
                biography: $row->biography ?? null,
                farewell: $row->farewell ?? null,
                photo: $row->photo ?? null
            );
        }
        return new self($pets);
    }

    public function toArray(): array
    {
        return array_map(fn(Pet $pet) => $pet->toArray(), $this->pets);
    }

}