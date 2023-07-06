<?php

namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function register($request): void;

    public function login($request): array;

    public function getUserData(): object;

    public function logout($request): void;
}
