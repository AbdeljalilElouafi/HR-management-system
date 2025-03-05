<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyRegistrationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\OrganigrammeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\CompensatoryDayRequestController;
use App\Http\Controllers\ProfileController;



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

Route::resource('leave-requests', LeaveRequestController::class)->middleware('auth');
Route::resource('compensatory-day-requests', CompensatoryDayRequestController::class)->middleware('auth');

Route::put('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');

Route::get('/company/register', [CompanyRegistrationController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [CompanyRegistrationController::class, 'register']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::view('/profile/show', 'profile.show')
//     ->middleware(['auth'])
//     ->name('profile.show');

Route::get('/profile/show', [ProfileController::class, 'show'])
    ->middleware(['auth'])
    ->name('profile.show');


require __DIR__.'/auth.php';
