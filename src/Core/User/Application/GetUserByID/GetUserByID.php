<?php

namespace Peludors\Core\User\Application\GetUserByID;

use Domain\UserNotFound;
use Exception;
use Peludors\Core\User\Domain\User;
use Peludors\Core\User\Domain\UserRepository;

class GetUserByID
{
    public function __construct(
        private UserRepository $userRepository
    ){
    }
    public function __invoke(GetUserByIDQuery $query): User
    {
        $id = $query->id();
        try {
            return $this->userRepository->findByID($id);
        }catch (Exception $exception){
            throw new UserNotFound('User not found for id '.$id);
        }
    }
}