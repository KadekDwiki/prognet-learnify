<?php

use App\Http\Controllers\Classes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Teachers\TeacherClassesController;
use App\Http\Controllers\Teachers\TeacherLessonsController;
use App\Http\Controllers\Teachers\TeacherAssignmentsController;
use App\Http\Controllers\Teacher\TeacherAssignmentsController as TeacherTeacherAssignmentsController;

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
    Route::get('/lessons/{id}', [ClassesController::class, 'lessons'])->name('classes.lessons');
    Route::get('/lessons/{classId}/{lessonsId}', [ClassesController::class, 'lessonDetail'])->name('classes.lesson_detail');
    Route::get('/assignments/{id}', [ClassesController::class, 'assignments'])->name('classes.assignments');
    Route::get('/assignments/{classId}/{assignmentId}', [ClassesController::class, 'assignmentDetail'])->name('classes.assignment_detail');
    Route::post('/assignments/uploadsubmission', [ClassesController::class, 'handleStudentSubmission'])->name('classes.upload_submission');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/dashboard/teachers', [DashboardController::class, 'dashboardTeachers'])->name('dashboard-teachers');

    Route::get('/classes-teachers', [TeacherClassesController::class, 'index'])->name('classes-teachers');

    Route::get('/lessons-teachers/{id}', [TeacherLessonsController::class, 'index'])->name('classes.lessons-teachers');
    Route::get('/lessons-teachers/{classId}/{lessonsId}', [TeacherLessonsController::class, 'show'])->name('lessons.detail');
    
    Route::get('/add-lessons/{classId}', [TeacherLessonsController::class, 'create'])->name('add-lessons');

    Route::get('/assignments/{id}', [TeacherAssignmentsController::class, 'index'])->name('assignments.index');
});