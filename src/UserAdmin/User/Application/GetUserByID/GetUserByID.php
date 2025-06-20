<?php

namespace Peludors\UserAdmin\User\Application\GetUserByID;

use Exception;
use Peludors\UserAdmin\User\Domain\User\User;
use Peludors\UserAdmin\User\Domain\User\UserNotFound;
use Peludors\UserAdmin\User\Domain\User\UserRepository;

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
            throw new UserNotFound('UserAdmin not found for id ' . $id);
        }
    }
}