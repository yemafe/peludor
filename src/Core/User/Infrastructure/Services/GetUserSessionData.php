<?php

namespace Infrastructure\Services;

use Domain\UserNotFound;

class GetUserSessionData
{
    public function __invoke(): ?array
    {
        //Más adelante generar un token desde js, persistir desde php y generar la cookie con los datos persistidos
        if (isset($_COOKIE['sessionToken'])) {
            $userData = null;
            $data = json_decode(urldecode($_COOKIE['sessionToken']), true);
            if (!empty($data['userID'])) {
                $userData = $data;
            }
            return $userData;
        } else {
            throw new UserNotFound('User not logged in.');
        }
    }
}