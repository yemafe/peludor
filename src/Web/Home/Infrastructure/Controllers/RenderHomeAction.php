<?php
namespace Peludors\Web\Home\Infrastructure\Controllers;

use Flight;
use Peludors\Core\User\Application\GetUserByID\GetUserByID;
use Twig\Environment;

class RenderHomeAction
{
    public function __construct(
        //private GetUserByID $getUserByID
    ) {}

    public function __invoke(?array $userData): void
    {
        $user = $userData;
        /*if (!is_null($userData)){
            $query = new GetUserByIDQuery($userData['userID']);
            $user = $this->getUserByID->__invoke($query)->toArray();
        }*/
        //echo $this->twig->render('index.twig', ['user' => $user]);
        echo Flight::view()->render('index.twig');
    }
}
