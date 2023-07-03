<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/major", [MajorController::class, "index"])->name("major.index");
Route::post("/major", [MajorController::class, "store"])->name("major.store");
Route::patch("/major/{id}", [MajorController::class, "update"])->name("major.update");
Route::delete("/major/{id}", [MajorController::class, "destroy"])->name("major.destroy");

Route::get("/student", [StudentController::class, "index"])->name("student.index");
Route::get("/student/major", [StudentController::class, "major"])->name("student.major");
Route::post("/student", [StudentController::class, "store"])->name("student.store");
Route::patch("/student/{id}", [StudentController::class, "update"])->name("student.update");
Route::delete("/student/{id}", [StudentController::class, "destroy"])->name("student.destroy");
