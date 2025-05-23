<?php

namespace Peludors\Core\User\Infrastructure\Services;

use Peludors\Core\User\Domain\UserNotFound;

class GetUserSessionData
{
    public function __invoke(): ?array
    {
        $userData = null;
        if (isset($_COOKIE['peludors'])) {
            $data = json_decode(urldecode($_COOKIE['peludors']), true);

            if (!empty($data['userID'])) {
                $userData = $data;
            }
        }
        return $userData;
    }
}