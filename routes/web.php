<?php

use App\Http\Controllers\Classes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TeacherAssignmentsController;
use App\Http\Controllers\TeacherClassesController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['guest'])->group(function () {
    // route login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

    // route register
    Route::get('/register', [RegisterController::class, 'index'])->name("register");
    Route::post('/register', [RegisterController::class, 'store'])->name("register.store");
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
    Route::get('/lessons/{id}', [ClassesController::class, 'show'])->name('classes.lessons');
    
    Route::get('/dashboard/teachers', [DashboardController::class, 'dashboardTeachers'])->name('dashboard-teachers');
    Route::get('/dashboard/classes-teachers', [TeacherClassesController::class, 'index'])->name('classes-teachers');
    Route::get('/dashboard/lessons-teachers/{id}', [TeacherClassesController::class, 'show'])->name('classes.lessons-teachers');
    Route::get('/assignments{id}', [TeacherAssignmentsController::class, 'index'])->name('assignments.index');
});