<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task',[TaskController::class,'task'])->name("task");
Route::post('/task/create',[TaskController::class,'create'])->name("task#create");
Route::post('/task/delete/{id}',[TaskController::class,'delete'])->name("task#delete");
