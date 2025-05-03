<?php

namespace Peludors\Core\User\Infrastructure\Services;

use Flight;

class CheckUserIsLoggedIn
{
    public function __invoke(): void
    {
        $view = Flight::view();
        if (isset($_COOKIE['peludorsToken'])) {
            $raw = urldecode($_COOKIE['peludorsToken']);
            $data = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                if (!empty($data['userID']) && isset($data['userName']) && isset($data['userEmail'])) {
                    $view->addGlobal('userSessionData', $data);
                    return;
                }
            }
        }
        $view->addGlobal('userSessionData', null);
        return;
    }
}