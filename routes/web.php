<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';

use Peludors\UserAdmin\Pet\Application\AddUserPet\AddPet;
use Peludors\UserAdmin\Pet\Application\GetPetsByUser\GetPetsByUser;
use Peludors\UserAdmin\Pet\Infrastructure\AddPetAction;
use Peludors\UserAdmin\Pet\Infrastructure\GetPetsByUserAction;
use Peludors\UserAdmin\Pet\Infrastructure\Repositories\PetMySQLRepository;
use Peludors\UserAdmin\User\Infrastructure\Controllers\SaveUserAction;
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

Flight::route('GET /userPanel', function () use ($container){
    (new GetPetsByUserAction(
        new GetPetsByUser(new PetMySQLRepository()),
        new GetUserSessionData()
    ))();
    //echo Flight::view()->render('userPanel.twig');
});

Flight::route('/obituary', function () use ($container){
    echo Flight::view()->render('obituary.twig');
});

Flight::route('POST /login/google/callback', function () {
    (new SaveUserAction())();
});

Flight::route('POST /pet/add' , function(){
    (new AddPetAction(
        new AddPet(new PetMySQLRepository()),
        new GetUserSessionData()
    ))();
});