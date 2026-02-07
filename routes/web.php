<?php

use App\Http\Controllers\Client\RequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Creator\ApplicationController;
use App\Http\Controllers\RequestApplication;
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
    Route::get('/requests/deleted', [RequestController::class, 'deletedIndex'])->name('requests.deleted.index');
    Route::get('/requests/deleted/{request}', [RequestController::class, 'deletedDetail'])->name('requests.deleted.detail');
    Route::patch('/requests/deleted/{request}/restore', [RequestController::class, 'restore'])->name('requests.deleted.restore');
    Route::get('/requests/{request}', [RequestController::class, 'detail'])->name('requests.detail');
    Route::get('/requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
    Route::patch('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');
    Route::delete('/requests/{request}', [RequestController::class, 'destroy'])->name('requests.destroy');
    Route::get('/requests/{request}/applications', [RequestApplication::class, 'clientApplicationsIndex'])->name('requests.applications');
    Route::get('/requests/{request}/applications/{application}', [RequestApplication::class, 'clientApplicationDetail'])->name('requests.applications.detail');
    Route::get('/applications', [RequestApplication::class, 'clientAllApplications'])->name('applications.index');
    Route::get('/applications/{application}', [RequestApplication::class, 'clientAllApplicationDetail'])->name('applications.detail');
});

Route::middleware(['auth','role:creator'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/deleted', [ApplicationController::class, 'deletedIndex'])->name('applications.deleted.index');
    Route::get('/applications/deleted/{application}', [ApplicationController::class, 'deletedDetail'])->name('applications.deleted.detail');
    Route::patch('/applications/deleted/{application}/restore', [ApplicationController::class, 'restore'])->name('applications.deleted.restore');
    Route::get('/applications/{application}', [ApplicationController::class, 'detail'])->name('applications.detail');
    Route::get('applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::match(['patch', 'post'], '/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    Route::prefix('requests')->name('requests.')->group(function () {
        Route::get('/', [RequestApplication::class, 'requestsShow'])->name('show');
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('show', [RequestApplication::class, 'applicationsShow'])->name('show');
            Route::get('show/{application}', [RequestApplication::class, 'applicationsShowDetail'])->name('show.detail');
            Route::delete('show/{application}', [RequestApplication::class, 'applicationsDestroy'])->name('destroy');
        });
        Route::get('/{request}', [RequestApplication::class, 'requestsDetail'])->name('detail');
        Route::get('/{request}/application',[RequestApplication::class, 'requestsApplication'])->name('application');
        Route::post('/{request}/applicationStore', [RequestApplication::class, 'requestsApplicationStore'])->name('applicationStore');
    });
});

require __DIR__.'/auth.php';
