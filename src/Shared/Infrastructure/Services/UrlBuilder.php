<?php

namespace Peludors\Shared\Infrastructure\Services;

final class UrlBuilder
{
    public static function baseUrl(): string
    {
        // Usa env o fallback
        return $_ENV['APP_URL'] ?? 'http://localhost:8000';
    }

    public static function petImage(string $filename): string
    {
        return self::baseUrl() . "/uploads/users/photo/pets/" . $filename;
    }

    public static function defaultDogImage(): string
    {
        return self::baseUrl() . "/img/dog-default.jpg";
    }

    public static function defaultCatImage(): string
    {
        return self::baseUrl() . "/img/cat-default.jpg";
    }

    public static function defaultRodentImage(): string
    {
        return self::baseUrl() . "/img/rodent-default.jpg";
    }
}