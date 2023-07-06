<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }

    //register
    public function register(RegisterRequest $request)
    {
        $this->userService->register($request);

        return response()->json(["message" => "create successfully!"]);
    }

    // login
    public function login(LoginRequest $request)
    {
        return response()->json($this->userService->login($request));
    }

    // getUser
    public function getUsers()
    {
        $users = $this->userService->getUserData();

        return response()->json($users);
    }

    // logout
    public function logout(Request $request)
    {
        $this->userService->logout($request);

        return response()->json(["message" => "logout successfully!"]);
    }
}
