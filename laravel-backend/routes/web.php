<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/variable-scope', [ProductController::class, 'index']);
Route::get('/global-variable', [ProductController::class, 'read']);
Route::get('/greet/{zell}', [ProductController::class, 'greet']);