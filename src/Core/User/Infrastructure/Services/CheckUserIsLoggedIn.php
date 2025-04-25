<?php

namespace Infrastructure\Services;

class CheckUserIsLoggedIn
{
    public function __invoke(): void
    {
        global $twig;
        if (isset($_COOKIE['sessionToken'])) {
            $data = json_decode(urldecode($_COOKIE['sessionToken']), true);
            if (!empty($data['userID'])) {
                echo $twig->render('navbar.twig', ['userSessionData' => $data]);
            }
            echo $twig->render('navbar.twig', ['userSessionData' => null]);
        }
    }
}