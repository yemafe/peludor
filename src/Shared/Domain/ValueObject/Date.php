<?php

namespace Peludors\Shared\Domain\ValueObject;

class Date
{
    private string $date;

    private function __construct(string $date)
    {
        $this->date = $date;
    }

    public static function fromTimestamp(int $timestamp): self
    {
        return new self(date('d/m/Y', $timestamp));
    }

    public function __toString(): string
    {
        return $this->date;
    }
}
