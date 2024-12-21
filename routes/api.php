<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
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

//Department
Route::get('/department/view', [DepartmentController::class, 'index']);
Route::post('/department/create', [DepartmentController::class, 'store']);
Route::put('/department/update/{DepartmentID}', [DepartmentController::class, 'update']);  
Route::delete('/department/delete/{DepartmentID}', [DepartmentController::class, 'destroy']);  

//student
Route::get('/student/view', [StudentController::class, 'index']);
Route::post('/student/create', [StudentController::class, 'store']);
Route::put('/student/update/{id}', [StudentController::class, 'update']);
Route::delete('/student/delete/{id}', [StudentController::class, 'destroy']);