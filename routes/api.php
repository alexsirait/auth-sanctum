<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/list', [AuthController::class, 'list']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
