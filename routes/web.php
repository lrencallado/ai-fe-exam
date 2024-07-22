<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ArticleController::class)->prefix('articles')->group(function () {
        Route::get('/', 'index')->name('articles.index');
        Route::get('/{article}/edit', 'edit')->name('articles.edit');
        Route::post('/store', 'store')->name('articles.store');
        Route::put('/{article}/update', 'update')->name('articles.update');
        Route::post('/{article}/publish', 'publish')->name('articles.publish');
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::get('/{user}/edit', 'edit')->name('users.edit');
        Route::post('/store', 'store')->name('users.store');
        Route::put('/{user}/update', 'update')->name('users.update');
    });

    Route::controller(CompanyController::class)->prefix('companies')->group(function () {
        Route::get('/', 'index')->name('companies.index');
        Route::get('/create', 'create')->name('companies.create');
        Route::get('/{company}/edit', 'edit')->name('companies.edit');
        Route::post('/store', 'store')->name('companies.store');
        Route::put('/{company}/update', 'update')->name('companies.update');
    });
});
