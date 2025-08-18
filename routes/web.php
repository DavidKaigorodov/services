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

    Route::resource('dashboard', DashboardController::class)
        ->only(['index']);

    Route::resource('service', ServiceController::class)
        ->except(['show']);

    Route::resource('cities', CityController::class)
        ->except(['show']);

    Route::resource('divisions', DivisionController::class);

    Route::resource('subscribes', SubscribeController::class);

    Route::resource('statistic', StatisticController::class)
        ->only(['index']);

    Route::resource('{division}/division-admins', DivisionAdminController::class)
        ->only(['index', 'create', 'store', 'destroy']);

    Route::resource('{division}/workers', WorkerController::class)
        ->only(['index','edit', 'update','destroy']);
});
