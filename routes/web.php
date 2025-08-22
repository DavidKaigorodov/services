<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionAdminController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->middleware('guest')->name('login');
    Route::post('/login', 'store')->middleware('guest')->name('auhtificate');
    Route::post('/logout', 'destroy')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    })->name('home');

    Route::resource('division/{division}/events', DashboardController::class)
        ->only(['index']);

    Route::resource('services', ServiceController::class)
        ->except(['show']);

    Route::resource('cities', CityController::class)
        ->except(['show']);

    Route::resource('divisions', DivisionController::class);

    Route::resource('division/{division}/subscribes', SubscribeController::class);

    Route::resource('statistic', StatisticController::class)
        ->only(['index']);

    Route::resource('divisions/{division}/division-admins', DivisionAdminController::class)
        ->only(['index', 'create', 'store', 'update', 'destroy']);

    Route::resource('divisions/{division}/workers', WorkerController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
