<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("register",[UserController::class,"register"]);
Route::post("login",[UserController::class,"login"]);
Route::get("users",[UserController::class,"getUsers"])->middleware("auth:sanctum");
Route::post("logout",[UserController::class,"logout"])->middleware("auth:sanctum");
