<?php

namespace Peludors\Shared\Infrastructure\Services;

final class TextSanitizer
{
    public static function sanitize(?string $value): string
    {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }
}