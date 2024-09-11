<?php
use Illuminate\Support\Facades\Route;

// Route for Login and Register
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
