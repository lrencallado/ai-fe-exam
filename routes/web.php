<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
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

    Route::controller(CompanyController::class)->prefix('companies')->group(function () {
        Route::get('/', 'index')->name('companies.index');
    });

    Route::controller(ArticleController::class)->prefix('articles')->group(function () {
        Route::get('/', 'index')->name('articles.index');
        Route::get('/{article}/edit', 'edit')->name('articles.edit');
        Route::post('/store', 'store')->name('articles.store');
        Route::put('/{article}/update', 'update')->name('articles.update');
        Route::post('/{article}/publish', 'publish')->name('articles.publish');
    });
});
