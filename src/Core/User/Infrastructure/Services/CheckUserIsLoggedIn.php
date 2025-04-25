<?php

namespace Peludors\Core\User\Infrastructure\Services;

class CheckUserIsLoggedIn
{
    public function __invoke(): ?string
    {
        global $twig;
        if (isset($_COOKIE['sessionToken'])) {
            $data = json_decode(urldecode($_COOKIE['sessionToken']), true);
            if (!empty($data['userID'])) {
                return $twig->render('navbar.twig', ['userSessionData' => $data]);
            }
        }
        return $twig->render('navbar.twig', ['userSessionData' => null]);
    }
}