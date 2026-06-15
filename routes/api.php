<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Student;

Route::apiResource('student', StudentController::class)
->names([
    'index' => 'api.students.index',
    'store' => 'api.students.store',
    'show' => 'api.students.show',
    'update' => 'api.students.update',
    'destroy' => 'api.students.destroy',
]);

Route::apiResource('products', ProductController::class)
->names([
    'index' => 'api.products.index',
    'store' => 'api.products.store',
    'show' => 'api.products.show',
    'update' => 'api.products.update',
    'destroy' => 'api.products.destroy',
]);