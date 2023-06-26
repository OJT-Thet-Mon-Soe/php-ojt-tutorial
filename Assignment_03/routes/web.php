<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/major", [MajorController::class, "index"])->name("major.index");
Route::get("/major/create", [MajorController::class, "create"])->name("major.create");
Route::post("/major", [MajorController::class, "store"])->name("major.store");
Route::get("/major/{id}/edit", [MajorController::class, "edit"])->name("major.edit");
Route::patch("/major/{id}", [MajorController::class, "update"])->name("major.update");
Route::delete("/major/{id}", [MajorController::class, "destroy"])->name("major.destroy");

Route::get("/student", [StudentController::class, "index"])->name("student.index");
Route::get("/student/create", [StudentController::class, "create"])->name("student.create");
Route::post("/student", [StudentController::class, "store"])->name("student.store");
Route::get("/student/{id}/edit", [StudentController::class, "edit"])->name("student.edit");
Route::patch("/student/{id}", [StudentController::class, "update"])->name("student.update");
Route::delete("/student/{id}", [StudentController::class, "destroy"])->name("student.destroy");

Route::get("/student/export", [StudentController::class, "export"])->name("student.export");
Route::get("/import", [StudentController::class, "import"])->name("student.import");
Route::post("/import", [StudentController::class, "importStore"])->name("student.import.store");
