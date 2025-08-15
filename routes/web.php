<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('/lms', function () {
    return view('navigation');
})->name('lms.navigation');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Student CRUD routes
Route::resource('students', StudentController::class);

// Course CRUD routes
Route::resource('courses', CourseController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
