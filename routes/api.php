<?php

use App\Http\Controllers\FreeTrialUserController;
use Illuminate\Support\Facades\Route;

Route::post('/free_user_register', [FreeTrialUserController::class, 'register']);

// domain validation
use App\Http\Controllers\UserCheckController;

Route::post('/check-field', [UserCheckController::class, 'checkField']);
