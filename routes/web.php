<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ServiceRequestController;
use App\Http\Controllers\Admin\ServiceRequestController as AdminServiceRequestController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\ProfileController;

Route::view('/', 'home')->name('home');

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Service Requests
    Route::get('/service-requests', [ServiceRequestController::class, 'index'])
        ->name('student.requests.index');

    Route::get('/service-requests/create', [ServiceRequestController::class, 'create'])
        ->name('student.requests.create');

    Route::post('/service-requests', [ServiceRequestController::class, 'store'])
        ->name('student.requests.store');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.edit');
    });     

    Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('student.notifications.index');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->name('student.notifications.read');

});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [
            AdminServiceRequestController::class,
            'dashboard'
        ])->name('dashboard');

        // Service Requests
        Route::get('/requests', [
            AdminServiceRequestController::class,
            'index'
        ])->name('requests.index');

        Route::put('/requests/{serviceRequest}', [
            AdminServiceRequestController::class,
            'update'
        ])->name('requests.update');

        // Student Management
        Route::get('/students', [
            AdminServiceRequestController::class,
            'students'
        ])->name('students.index');

    });

