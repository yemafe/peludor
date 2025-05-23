<?php

namespace Peludors\Core\User\Infrastructure\Services;

use Peludors\Core\User\Domain\UserNotFound;

class GetUserSessionData
{
    public function __invoke(): ?array
    {
        //Más adelante generar un token desde js, persistir desde php y generar la cookie con los datos persistidos
        $userData = null;
        if (isset($_COOKIE['peludorsToken'])) {
            $data = json_decode(urldecode($_COOKIE['peludorsToken']), true);

            if (!empty($data['userID'])) {
                $userData = $data;
            }
        }
        return $userData;
    }
}