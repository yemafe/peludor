<?php
define('__ROOT_DIR__', dirname(__DIR__));
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Core/Config/DatabaseConnection.php';
use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Illuminate\Support\Facades\DB;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Google headers
header(
    "Content-Security-Policy: " .
    "default-src 'self'; " .
    "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://apis.google.com https://accounts.google.com https://www.gstatic.com https://ajax.googleapis.com https://code.jquery.com https://cdnjs.cloudflare.com; " .
    "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; " .
    "font-src 'self' https://fonts.gstatic.com; " .
    "img-src 'self' data: https://*; " .
    "connect-src 'self' https://www.googleapis.com https://accounts.google.com; " .
    "frame-src 'self' https://accounts.google.com; " .
    "object-src 'none'; " .
    "base-uri 'self';"
);



// REGISTRA Twig EN Flight
Flight::register('view', Environment::class, [
    new FilesystemLoader(__DIR__ . '/../templates'),
], function($twig) {
});
require_once __DIR__ . '/../routes/web.php';

Flight::start();



