<?php

use Infrastructure\Services\CheckUserIsLoggedIn;

require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => 'index.twig',
    '/about' => 'about.twig',
    '/errorPage' => 'errorPage.twig',
    '/login' => 'login.twig',
    '/magazine' => 'magazine.twig',
    '/obituary' => 'obituary.twig'
];

if (array_key_exists($route, $routes)) {
    CheckUserIsLoggedIn::class->__invoke();
    echo $twig->render($routes[$route]);
} else {
    echo $twig->render('errorPage.twig', []);
}
