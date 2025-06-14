<?php

namespace Peludors\Core\User\Application\GetUserByID;

use Exception;
use Peludors\Core\User\Domain\User\User;
use Peludors\Core\User\Domain\User\UserNotFound;
use Peludors\Core\User\Domain\User\UserRepository;

readonly class GetUserByID
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
            throw new UserNotFound('User not found for id ' . $id);
        }
    }
}