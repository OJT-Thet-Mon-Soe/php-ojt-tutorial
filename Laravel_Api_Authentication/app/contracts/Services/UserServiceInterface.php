<?php

namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function register($request): void;

    public function login($request): array;

    public function getUserData(): object;

    public function logout($request): void;
}
