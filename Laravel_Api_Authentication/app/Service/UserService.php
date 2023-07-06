<?php

namespace App\Service;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userDao;

    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDao = $userDaoInterface;
    }

    public function register($request): void
    {
        $this->userDao->register($request);
    }

    public function login($request): array
    {
        return $this->userDao->login($request);
    }

    public function getUserData(): object
    {
        return $this->userDao->getUserData();
    }

    public function logout($request): void
    {
        $this->userDao->logout($request);
    }
}
