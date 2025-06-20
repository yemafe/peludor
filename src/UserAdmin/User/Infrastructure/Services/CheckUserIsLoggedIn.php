<?php

namespace Peludors\UserAdmin\User\Infrastructure\Services;
use Flight;

class CheckUserIsLoggedIn
{
    public function __invoke(): void
    {
        $view = Flight::view();
        if (isset($_COOKIE['peludors'])) {
            $raw = urldecode($_COOKIE['peludors']);
            $data = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                if (!empty($data['userID']) && isset($data['userName'])) {
                    $view->addGlobal('userSessionData', $data);
                    return;
                }
            }
        }
        $view->addGlobal('userSessionData', null);
        return;
    }
}