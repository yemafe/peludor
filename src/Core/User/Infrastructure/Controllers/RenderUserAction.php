<?php
namespace Peludors\Core\User\Infrastructure\Controllers;

use Peludors\Core\User\Application\GetUserByID\GetUserByID;
use Peludors\Core\User\Application\GetUserByID\GetUserByIDQuery;
use Twig\Environment;

class RenderUserAction
{
    public function __construct(
        private GetUserByID $getUserByID,
        private Environment $twig
    ) {}

    public function __invoke(int $id): void
    {
        //llamar a GetUserSession y obtener datos del userID de la cookie
        $query = new GetUserByIDQuery($id);
        $user = $this->getUserByID->__invoke($query);
        echo $this->twig->render('userPanel.twig', ['user' => $user]);
    }
}
