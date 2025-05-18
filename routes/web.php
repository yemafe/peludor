<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';
use Peludors\Core\User\Application\GetUserByID\GetUserByID;
use Peludors\Core\User\Infrastructure\Controllers\RenderUserAction;
use Peludors\Core\User\Infrastructure\Repository\UserMySQLRepository;
use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;

Flight::set('di', $container);
Flight::before('start', function (&$params, &$output) use ($container) {
    $check = new CheckUserIsLoggedIn();
    $check();
});

Flight::route('GET /', function () use ($container){
   /* $getUserByID = $container->get(GetUserByID::class);
    $user = $getUserByID(1);*/
    $controller = $container->get(RenderUserAction::class);
    $controller(1);
   // echo Flight::view()->render('index.twig', ['user' => $user]);
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