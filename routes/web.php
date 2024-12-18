<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Teachers\TeacherClassesController;
use App\Http\Controllers\Teachers\TeacherLessonsController;
use App\Http\Controllers\Teachers\TeacherAssignmentsController;
use App\Http\Controllers\ReminderController;

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

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['role:student'])->group(function () {
        Route::get('/classes', [ClassesController::class, 'index'])->name('classes');

        Route::get('/lessons/{id}', [ClassesController::class, 'lessons'])->name('classes.lessons');
        Route::get('/lessons/{classId}/{lessonsId}', [ClassesController::class, 'lessonDetail'])->name('classes.lesson_detail');

        Route::get('/assignments/{id}', [ClassesController::class, 'assignments'])->name('classes.assignments');
        Route::get('/assignments/{classId}/{assignmentId}', [ClassesController::class, 'assignmentDetail'])->name('classes.assignment_detail');
        Route::post('/assignments/uploadsubmission', [ClassesController::class, 'handleStudentSubmission'])->name('classes.upload_submission');

        Route::post('/join-class', [ClassesController::class, 'joinClass'])->name('join.class');

        Route::get('/members/{id}', [ClassesController::class, 'showMembers'])->name('classes.members');
        Route::post('/classes/{class}/leave', [ClassesController::class, 'leaveClass'])->name('classes.leave');

        Route::get('/reminder', [ReminderController::class, 'index'])->name('reminder');
    });

    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/classes-teachers', [TeacherClassesController::class, 'index'])->name('classes-teachers');
        Route::post('/classes/store', [TeacherClassesController::class, 'store'])->name('classes.store');

        Route::get('/lessons-teachers/{id}', [TeacherLessonsController::class, 'index'])->name('classes.lessons-teachers');
        Route::get('/lessons-teachers/{classId}/{lessonsId}', [TeacherLessonsController::class, 'show'])->name('lessons.detail');
        Route::get('/add-lessons/{classId}', [TeacherLessonsController::class, 'create'])->name('add-lessons');
        Route::delete('/lessons-teachers/{id}', [TeacherLessonsController::class, 'destroy'])->name('lessons-teachers.destroy');
        Route::post('/lessons', [TeacherLessonsController::class, 'store'])->name('lessons.store');
        Route::get('/edit-lessons/{id}', [TeacherLessonsController::class, 'edit'])->name('lessons.edit');
        Route::put('/update-lessons/{id}', [TeacherLessonsController::class, 'update'])->name('lessons.update');

        Route::get('/assignments-teachers/{classId}', [TeacherAssignmentsController::class, 'index'])->name('assignments.index');
        Route::get('/assignments-create/{classId}', [TeacherAssignmentsController::class, 'create'])->name('assignments.create');
        Route::post('/assignments-teachers/store', [TeacherAssignmentsController::class, 'store'])->name('assignments.store');
        Route::get('/assignments-teachers/edit/{classId}', [TeacherAssignmentsController::class, 'edit'])->name('assignments.edit');
        Route::put('/assignments-teachers/update/{id}', [TeacherAssignmentsController::class, 'update'])->name('assignments.update');
        Route::get('/assignments-teacher/{classId}/{assignmentId}', [TeacherAssignmentsController::class, 'showDetail'])->name('assignments.showDetail');
        Route::delete('/assignments-teachers/{classId}', [TeacherAssignmentsController::class, 'destroy'])->name('assignments.destroy');

        Route::get('/members-teachers/{id}', [TeacherClassesController::class, 'showMembers'])->name('classes.members-teachers');
        Route::post('/delete-members/{student_id}', [TeacherClassesController::class, 'destroy'])->name('members-teachers.destroy');
        Route::get('/grades/{assignmentId}', [TeacherClassesController::class, 'showGrade'])->name('members-grade.show-grade');

        Route::get('/submissions-teacher/{classId}/{assigmentId}', [TeacherAssignmentsController::class, 'showSubmissionsByAssignmentId'])->name('submissions-teacher');
        Route::put('/submissions-teacher/update-grade', [TeacherAssignmentsController::class, 'updateSubmissionGrade'])->name('submissions-teacher.update_grade');
    });
});
