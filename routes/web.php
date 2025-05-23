<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';

use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;
use Peludors\Core\User\Infrastructure\Services\GetUserSessionData;
use Peludors\Web\Home\Infrastructure\Controllers\RenderHomeAction;

Flight::set('di', $container);
Flight::before('start', function (&$params, &$output) use ($container) {
    (new CheckUserIsLoggedIn())();
});

Flight::route('/', function () use ($container){
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