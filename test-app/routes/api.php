<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getDepartment', [DepartmentController::class, 'index']);
Route::post('createDepartment', [DepartmentController::class, 'store']);
Route::post('updateDepartment', [DepartmentController::class, 'update']);
Route::post('deleteDepartment', [DepartmentController::class, 'destroy']);
Route::post('searchEmployee', [EmployeeController::class, 'employee_search']);
