<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Product1Controller;
use Illuminate\Support\Facades\Route;

Route::get('products/queries', [Product1Controller::class, 'queries'])->name('products.queries');
Route::apiResource('products', ProductController::class)
    ->only(['index', 'show']);
Route::apiResource('categories', CategoriesController::class);
