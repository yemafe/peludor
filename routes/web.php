<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';

use Peludors\UserAdmin\User\Application\AddUserPet\AddUserPet;
use Peludors\UserAdmin\User\Infrastructure\Controllers\AddUserPetAction;
use Peludors\UserAdmin\User\Infrastructure\Controllers\SaveUserAction;
use Peludors\UserAdmin\User\Infrastructure\Repository\PetMySQLRepository;
use Peludors\UserAdmin\User\Infrastructure\Services\CheckUserIsLoggedIn;
use Peludors\UserAdmin\User\Infrastructure\Services\GetUserSessionData;
use Peludors\Web\Home\Infrastructure\Controllers\RenderHomeAction;

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

Flight::route('POST /pet/add' , function(){
    (new AddUserPetAction(
        new AddUserPet(new PetMySQLRepository()),
        new GetUserSessionData()
    ))();
});