<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establecer cabeceras de seguridad CPS de google para poder usar su login
header("Content-Security-Policy: 
    default-src 'self'; 
    script-src 'self' 'unsafe-inline' 'unsafe-eval' https://apis.google.com https://accounts.google.com https://www.gstatic.com https://ajax.googleapis.com https://code.jquery.com https://cdnjs.cloudflare.com;
    style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com;
    font-src 'self' https://fonts.gstatic.com;
    img-src 'self' data: https://*;
    connect-src 'self' https://www.googleapis.com https://accounts.google.com;
    frame-src 'self' https://accounts.google.com;
    object-src 'none';
    base-uri 'self';
");

use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;

require_once __DIR__ . '/vendor/autoload.php';
//twig conf
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // false for development
    'debug' => true, // true for development
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

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
    (new CheckUserIsLoggedIn())();
    echo $twig->render($routes[$route]);
} else {
    echo $twig->render('errorPage.twig', []);
}
