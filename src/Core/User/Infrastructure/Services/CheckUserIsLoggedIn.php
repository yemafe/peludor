<?php

namespace Peludors\Core\User\Infrastructure\Services;

class CheckUserIsLoggedIn
{
    public function __invoke(): ?string
    {
        global $twig;
        if (isset($_COOKIE['sessionToken'])) {
            $raw = urldecode($_COOKIE['sessionToken']);
            $data = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                if (!empty($data['userID']) && isset($data['userName']) && isset($data['userEmail'])) {
                    $twig->addGlobal('userSessionData', $data);
                    return $twig->render('navbar.twig', ['userSessionData' => $data]);
                }
            }
        }
        $twig->addGlobal('userSessionData', null);
        return $twig->render('navbar.twig');
    }
}