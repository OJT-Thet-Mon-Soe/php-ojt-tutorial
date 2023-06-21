<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task',[TaskController::class,'index'])->name("task.index");
Route::post('/task/store',[TaskController::class,'store'])->name("task.store");
Route::delete('/task/{id}',[TaskController::class,'destroy'])->name("task.destroy");
