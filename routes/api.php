<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppUserController;

Route::post('/register', [AppUserController::class, 'register']);
Route::post('/login', [AppUserController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AppUserController::class, 'logout']);
