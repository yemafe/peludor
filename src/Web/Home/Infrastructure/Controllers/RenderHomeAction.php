<?php
namespace Peludors\Web\Home\Infrastructure\Controllers;

use Peludors\Core\User\Application\GetUserByID\GetUserByID;
use Peludors\Core\User\Application\GetUserByID\GetUserByIDQuery;
use Twig\Environment;

class RenderHomeAction
{
    public function __construct(
        private GetUserByID $getUserByID,
        private Environment $twig
    ) {}

    public function __invoke(?array $userData): void
    {
        $user = $userData;
        if (!is_null($userData)){
            $query = new GetUserByIDQuery($userData['userID']);
            $user = $this->getUserByID->__invoke($query)->toArray();
        }
        echo $this->twig->render('index.twig', ['user' => $user]);
    }
}
