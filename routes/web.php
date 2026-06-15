<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/student',function (){
    return redirect()->route('students.index');

});

Route::get('/student', function () {
    $students = Student::query()->latest()->get();

    return view('student.index', compact('students'));
});

Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');

Route::get('/students/create', [StudentController::class, 'create'])
    ->name('students.create');

Route::post('/students/store', [StudentController::class, 'store'])
    ->name('students.store');
    
Route::get('/students/{id}', [StudentController::class, 'edit'])
    ->name('students.edit');
    
Route::put('/students/{id}', [StudentController::class, 'update'])
    ->name('students.update');

// Product Web Routes
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');
