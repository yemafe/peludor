<?php

namespace Peludors\UserAdmin\Pet\Infrastructure;

use Flight;
use Peludors\UserAdmin\Pet\Application\GetPetsByUser\GetPetsByUser;
use Peludors\UserAdmin\Pet\Application\GetPetsByUser\GetPetsByUserQuery;
use Peludors\UserAdmin\User\Infrastructure\Services\GetUserSessionData;

class GetPetsByUserAction
{
    public function __construct(
        protected GetPetsByUser $getPetsByUser,
        protected GetUserSessionData $getUserSessionData
    ){
    }

    public function __invoke(): void
    {
        $userID = $this->getUserSessionData->__invoke()['userID'];

        $command = new GetPetsByUserQuery($userID);
        $pets = $this->getPetsByUser->__invoke($command);
        echo Flight::view()->render('UserPanel.twig', ['pets'=> $pets->toArray()]);
    }
}