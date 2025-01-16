<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WellnessLogsController;
use App\Http\Controllers\CrisisPlanController;
use App\Http\Controllers\CrisisPlanLogsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['verified'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)
        ->name('profile.')
        ->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

    Route::controller(WellnessLogsController::class)
        ->prefix('wellness')
        ->name('wellness.')
        ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });

    Route::controller(CrisisPlanController::class)
        ->prefix('crisis_plan')
        ->name('crisis_plan.')
        ->group(function() {
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });
    
    Route::controller(CrisisPlanLogsController::class)
        ->prefix('logs')
        ->name('logs.')
        ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
