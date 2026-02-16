<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas para el CRUD de Cursos y Estudiantes
Route::apiResource('courses', CourseController::class);
Route::apiResource('students', StudentController::class);

// Esta ruta viene por defecto, puedes dejarla o quitarla, no afecta a tu CRUD
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');