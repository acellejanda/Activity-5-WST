<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRCalculatorController;
use App\Http\Controllers\PayrollController;
Route::post('/calculator', [HRCalculatorController::class, 'calculator']);
Route::post('/payroll', [PayrollController::class, 'PayrollController']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
