<?php

namespace Peludors\UserAdmin\User\Infrastructure\Controllers;

use Google_Client;
use Peludors\UserAdmin\User\Infrastructure\Models\UserModel;

class SaveUserAction
{
    private string $clientId;

    public function __construct()
    {
        $this->clientId = '794332473703-40fudvsd5va31nsar1276m49qse1bfcb.apps.googleusercontent.com';
    }

    public function __invoke(): void
    {
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

        $_SESSION['userID'] = $user->id;

        $this->setCookie([
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
                'name' => $payload['given_name'] ?? null,
                'email' => $email,
                'surname' => $payload['family_name'] ?? null,
                'avatar' => $payload['picture'] ?? null,
                'source' => $payload['iss'] ?? null,
                'created_at' => time(),
            ]);
        }
        return $user;
    }

    private function setCookie(array $data): void
    {
        $cookieValue = json_encode([
            'userID' => $data['userID'],
            'userName' => $data['userName']
        ]);

        setcookie(
            'peludors',
            $cookieValue,
            [
                'expires' => time() + 86400,
                'path' => '/',
                'secure' => true,
                'httponly' => false,
                'samesite' => 'Lax'
            ]
        );
    }

    private function respondWithError(string $message): void
    {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $message]);
    }
}
