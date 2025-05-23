<?php

namespace Peludors\Core\User\Infrastructure\Services;

class TokenDecryptor
{
    private string $encryptionKey;

    public function __construct(string $encryptionKey)
    {
        $this->encryptionKey = $encryptionKey;
    }

    public function __invoke(string $encodedToken): ?array
    {
        $raw = base64_decode($encodedToken);
        if (!$raw || strlen($raw) < 17) {
            return null;
        }

        $iv = substr($raw, 0, 16);
        $ciphertext = substr($raw, 16);

        $plaintext = openssl_decrypt(
            $ciphertext,
            'AES-256-CBC',
            $this->encryptionKey,
            0,
            $iv
        );

        if (!$plaintext) {
            return null;
        }

        return json_decode($plaintext, true);
    }
}
