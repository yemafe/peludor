<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';

use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;
use Peludors\Core\User\Infrastructure\Services\GetUserSessionData;
use Peludors\Web\Home\Infrastructure\Controllers\RenderHomeAction;
use Peludors\Core\User\Infrastructure\Controllers\SaveUserAction;

Flight::set('di', $container);
Flight::before('start', function (&$params, &$output) use ($container) {
    (new CheckUserIsLoggedIn())();
});

Flight::route('GET /', function () use ($container){
    $userCookieData = (new GetUserSessionData())();
    $container->get(RenderHomeAction::class)($userCookieData);
});


Flight::route('/login', function () use ($container){
    echo Flight::view()->render('login.twig');
});

Flight::route('/userPanel', function () use ($container){
    echo Flight::view()->render('userPanel.twig');
});

Flight::route('/obituary', function () use ($container){
    echo Flight::view()->render('obituary.twig');
});

Flight::route('POST /login/google/callback', function () {
    (new SaveUserAction())();
});