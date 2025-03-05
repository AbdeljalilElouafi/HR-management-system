<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyRegistrationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\OrganigrammeController;


// Route::view('/', 'dashboard');

Route::middleware('company')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('emplois', EmploiController::class);
    Route::resource('trainings', TrainingController::class);
    Route::post('/employees/{employee}/add-career-change', [EmployeeController::class, 'addCareerChange'])->name('employees.addCareerChange');
});

// organigramme
Route::get('/organigramme', [OrganigrammeController::class, 'index'])->name('organigramme.index');

Route::get('/company/register', [CompanyRegistrationController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [CompanyRegistrationController::class, 'register']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
