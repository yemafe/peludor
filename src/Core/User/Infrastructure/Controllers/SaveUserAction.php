<?php

namespace Peludors\Core\User\Infrastructure\Controllers;

use Google_Client;
use Peludors\Core\User\Infrastructure\Models\UserModel;

class SaveUserAction
{
    private string $clientId;
    private string $encryptionKey;

    public function __construct()
    {
        $this->clientId = getenv('GOOGLE_CLIENT_ID') ?: 'TU_GOOGLE_CLIENT_ID';
        $this->encryptionKey = getenv('ENCRYPTION_KEY') ?: 'TU_CLAVE_32_CHARS';
    }

    public function __invoke(): void
    {

        // UF ver todooo despacito https://chatgpt.com/c/68306866-b8ec-8000-b5e5-d2fcd2dfa0b5
        session_start();
        header('Content-Type: application/json');

        $data = $this->getRequestData();
        if (!$data || empty($data['id_token'])) {
            $this->respondWithError('Token faltante');
            return;
        }

        $payload = $this->verifyGoogleToken($data['id_token']);
        if (!$payload) {
            $this->respondWithError('Token inválido');
            return;
        }

        $user = $this->getOrCreateUser($payload);

        $_SESSION['user_id'] = $user->id;

        $this->setEncryptedCookie([
            'userID' => $user->id,
            'userName' => $user->name
        ]);

        echo json_encode(['success' => true]);
    }

    private function getRequestData(): ?array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    private function verifyGoogleToken(string $idToken): ?array
    {
        $client = new Google_Client(['client_id' => $this->clientId]);
        return $client->verifyIdToken($idToken);
    }

    private function getOrCreateUser(array $payload): UserModel
    {
        $email = $payload['email'];
        $user = UserModel::where('email', $email)->first();

        if (!$user) {
            $user = UserModel::create([
                'name' => $payload['name'] ?? '',
                'email' => $email,
                'given_name' => $payload['given_name'] ?? '',
                'family_name' => $payload['family_name'] ?? '',
                'avatar' => $payload['picture'] ?? null,
            ]);
        }

        return $user;
    }

    private function setEncryptedCookie(array $data): void
    {
        $token = $this->encryptTokenData($data);

        setcookie('peludorsToken', $token, [
            'expires' => time() + 86400,
            'path' => '/',
            'secure' => true,
            'httponly' => false,
            'samesite' => 'Lax'
        ]);
    }

    private function encryptTokenData(array $data): string
    {
        $iv = random_bytes(16);
        $cipher = "AES-256-CBC";
        $plaintext = json_encode($data);
        $encrypted = openssl_encrypt($plaintext, $cipher, $this->encryptionKey, 0, $iv);

        return base64_encode($iv . $encrypted);
    }

    private function respondWithError(string $message): void
    {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $message]);
    }
}
