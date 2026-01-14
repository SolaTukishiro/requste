<?php

use App\Http\Controllers\Client\RequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Creator\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{request}', [RequestController::class, 'detail'])->name('requests.detail');
    Route::get('requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
    Route::patch('/requests/{requestModel}', [RequestController::class, 'update'])->name('requests.update');
});

Route::middleware(['auth','role:creator'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [ApplicationController::class, 'detail'])->name('applications.detail');
    Route::get('applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::match(['patch', 'post'], '/applications/{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');
});

require __DIR__.'/auth.php';
