<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;


Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/services', [ViewController::class, 'services'])->name('services');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

Route::get('/register', [ViewController::class, 'register'])->name('register');
Route::get('/login', [ViewController::class, 'login'])->name('login');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/admin-dashboard', [ViewController::class, 'adminDashboard'])->name('admin-dashboard');
    Route::post('/categories', [AdminController::class, 'addCategories'])->name('add-categories');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('delete-category');
    Route::patch('/categories/{id}/toggle-status', [AdminController::class, 'toggleCategoryStatus'])->name('toggle-category-status');
    Route::put('/categories/{id}/update-name', [AdminController::class, 'updateCategoryName'])->name('update-category-name');
    
    Route::post('/services', [AdminController::class, 'addServices'])->name('add-services');
    Route::post('/appointment', [AdminController::class, 'addAppointment'])->name('add-appointment');
    Route::post('/customers/{id}/block', [AdminController::class, 'blockCustomer'])->name('block-customer');
    Route::post('/customers/{id}/unblock', [AdminController::class, 'unblockCustomer'])->name('unblock-customer');
    Route::put('/appointments/{id}', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AdminController::class, 'deleteAppointment'])->name('delete-appointment');

    Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/user-dashboard', [ViewController::class, 'userDashboard'])->name('user-dashboard');
    Route::post('/userAppointment', [UserController::class, 'addUserAppointment'])->name('userAddAppointment');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::post('/change-password', [UserController::class, 'changePassword']);
});



Route::post('/register', [AuthController::class, 'registerPost'])->name('register-post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login-post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');