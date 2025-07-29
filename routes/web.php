<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group([], [
    base_path('routes/web/auth.php'),
    base_path('routes/web/admin.php'),
    base_path('routes/web/division.php')
]);

Route::get('/glossary', [DashboardController::class, 'index'])->name('home');
