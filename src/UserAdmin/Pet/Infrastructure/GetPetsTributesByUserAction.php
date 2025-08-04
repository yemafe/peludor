<?php

namespace Peludors\UserAdmin\Pet\Infrastructure;

use Flight;
use Peludors\UserAdmin\Pet\Application\GetPetsTributesByUser\GetPetsTributesByUser;
use Peludors\UserAdmin\Pet\Application\GetPetsTributesByUser\GetPetsTributesByUserQuery;
use Peludors\UserAdmin\User\Infrastructure\Services\GetUserSessionData;

class GetPetsTributesByUserAction
{
    public function __construct(
        protected GetPetsTributesByUser $getPetsByUser,
        protected GetUserSessionData    $getUserSessionData
    ){
    }

    public function __invoke(): void
    {
        $userID = $this->getUserSessionData->__invoke()['userID'];

        $command = new GetPetsTributesByUserQuery($userID);
        $pets = $this->getPetsByUser->__invoke($command);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);
        echo Flight::view()->render(
            'UserPanel.twig', [
                    'pets'=> $pets->toArray(),
                    'message' => $message
            ]);
    }
}