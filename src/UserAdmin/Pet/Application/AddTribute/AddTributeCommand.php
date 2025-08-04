<?php

namespace Peludors\UserAdmin\Pet\Application\AddTribute;

use AllowDynamicProperties;
use DomainException;

#[AllowDynamicProperties] class AddTributeCommand
{
    public function __construct( array $data )
    {
        $this->userID = (int) $data['userID'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->breed = $data['breed'];
        $this->birthDate = (int) $data['birthDate'];
        $this->deathDate = (int) $data['deathDate'];
        $this->mixedBreed = (int) $data['mixedBreed'];
        $this->biography = $data['biography'];
        $this->farewell = $data['farewell'];
        $this->photoPath = $data['photoPath'];

        $this->validate();
    }

    public function userID(): int
    {
        return $this->userID;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function breed(): ?string
    {
        return $this->breed;
    }

    public function birthDate(): string
    {
        return $this->birthDate;
    }

    public function deathDate(): string
    {
        return $this->deathDate;
    }

    public function mixedBreed(): bool
    {
        return $this->mixedBreed;
    }

    public function biography(): ?string
    {
        return $this->biography;
    }

    public function farewell(): ?string
    {
        return $this->farewell;
    }

    public function photoPath(): ?string
    {
        return $this->photoPath;
    }

    private function validate(): void
    {
        if ($this->deathDate < $this->birthDate) {
            throw new DomainException('La fecha de fallecimiento no puede ser anterior a la de nacimiento.');
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s\-]{2,100}$/u', $this->name)) {
            throw new DomainException('Nombre inválido.');
        }

        if (!in_array($this->type, ['perro', 'gato', 'otro'])) {
            throw new DomainException('Tipo de mascota no válido.');
        }
    }
}