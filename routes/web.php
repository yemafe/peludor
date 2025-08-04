<?php
$container = require __DIR__ . '/../src/Core/Config/Classes.php';

use Peludors\UserAdmin\Pet\Application\AddTribute\AddTribute;
use Peludors\UserAdmin\Pet\Application\GetPetsTributesByUser\GetPetsTributesByUser;
use Peludors\UserAdmin\Pet\Infrastructure\AddTributeAction;
use Peludors\UserAdmin\Pet\Infrastructure\GetPetsTributesByUserAction;
use Peludors\UserAdmin\Pet\Infrastructure\Repositories\PetTributeMySQLRepository;
use Peludors\UserAdmin\User\Infrastructure\Controllers\SaveUserAction;
use Peludors\UserAdmin\User\Infrastructure\Services\CheckUserIsLoggedIn;
use Peludors\UserAdmin\User\Infrastructure\Services\GetUserSessionData;
use Peludors\Web\Home\Application\RenderHome;
use Peludors\Web\Home\Infrastructure\Controllers\RenderHomeAction;

Flight::set('di', $container);
Flight::before('start', function (&$params, &$output) use ($container) {
    (new CheckUserIsLoggedIn())();
});

Flight::route('GET /', function () use ($container){
    //$container->get(RenderHomeAction::class);
    (new RenderHomeAction(
        new RenderHome(new PetTributeMySQLRepository())
    ))();
});


Flight::route('/login', function () use ($container){
    echo Flight::view()->render('login.twig');
});

Flight::route('GET /userPanel', function () use ($container){
    (new GetPetsTributesByUserAction(
        new GetPetsTributesByUser(new PetTributeMySQLRepository()),
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

Flight::route('POST /tribute/add' , function(){
    (new AddTributeAction(
        new AddTribute(new PetTributeMySQLRepository()),
        new GetUserSessionData()
    ))();
});