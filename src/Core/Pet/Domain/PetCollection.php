<?php

namespace Peludors\Core\Pet\Domain;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class PetCollection implements IteratorAggregate
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
                id: $row->id,
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

}