<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyRegistrationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


Route::view('/', 'welcome');

Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);


Route::get('/company/register', [CompanyRegistrationController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [CompanyRegistrationController::class, 'register']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
