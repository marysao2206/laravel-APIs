<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', function () {
    $categories = Category::query()
        ->latest()
        ->get();

    return view('categories.index', compact('categories'));
});
