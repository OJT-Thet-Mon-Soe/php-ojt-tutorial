<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    public function register($request): void
    {
        $createData = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "password" => $request->password,
        ];
        User::create($createData);
    }

    public function login($request): array
    {
        $user = User::where("email", $request->email)->first();
        if ($user != "") {

            $userPw = $user->password;
            if (Hash::check($request->password, $userPw)) {
                $tokenName = 'API Token';
                $token = $user->createToken($tokenName)->plainTextToken;

                return [
                    "message" => "success",
                    'token' => $token
                ];
            } else {
                return [
                    "message" => "Password is wrong",
                    "token" => null,
                ];
            }
        } else {
            return [
                "message" => "Email is wrong",
                "token" => null,
            ];
        }
    }

    public function getUserData(): object
    {
        return User::get();
    }

    public function logout($request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
