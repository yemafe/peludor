<?php

use Peludors\Core\User\Infrastructure\Services\CheckUserIsLoggedIn;

Flight::before('start', function (&$params, &$output) {
    $check = new CheckUserIsLoggedIn();
    $check();
});

Flight::route('/', function (){
    //$users = \Peludors\Models\User::all();
    //echo $twig->render('home.twig', ['users' => $users]);
    echo Flight::view()->render('index.twig');
});


Flight::route('/login', function (){
    echo Flight::view()->render('login.twig');
});

Flight::route('/userPanel', function (){
    echo Flight::view()->render('userPanel.twig');
});

Flight::route('/obituary', function (){
    echo Flight::view()->render('obituary.twig');
});