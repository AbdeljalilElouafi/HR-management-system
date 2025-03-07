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
use App\Http\Controllers\ManagerLeaveRequestController;
use App\Http\Controllers\HRLeaveRequestController;
use App\Http\Controllers\DashboardController;







// Company Registration routes
Route::get('/company/register', [CompanyRegistrationController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/company/register', [CompanyRegistrationController::class, 'register']);

// Dashboard access limited to: (Admin, HR, Manager, Employee)
Route::middleware(['auth', 'role:admin,hr,manager,employee'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// Employees access limited to: (Admin, HR, Manager)
Route::middleware(['auth', 'company', 'role:admin,hr,manager'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::post('/employees/{employee}/add-career-change', [EmployeeController::class, 'addCareerChange'])->name('employees.addCareerChange');
});

// Departments access limited to: (Admin, Manager)
Route::middleware(['auth', 'company', 'role:admin,manager'])->group(function () {
    Route::resource('departments', DepartmentController::class);
});

// Jobs access limited to: (Admin, HR, Manager)
Route::middleware(['auth', 'company', 'role:admin,hr,manager'])->group(function () {
    Route::resource('emplois', EmploiController::class);
});

// Trainings access limited to: (Admin, HR, Manager, Employee)
Route::middleware(['auth', 'company', 'role:admin,hr,manager,employee'])->group(function () {
    Route::resource('trainings', TrainingController::class);
});

// Organigramme access limited to: (Admin, HR, Manager, Employee)
Route::middleware(['auth', 'role:admin,hr,manager,employee'])->group(function () {
    Route::get('/organigramme', [OrganigrammeController::class, 'index'])->name('organigramme.index');
});

// Leave Requests access limited to: (Admin, HR, Manager, Employee)
Route::middleware(['auth', 'role:admin,hr,manager,employee'])->group(function () {
    Route::resource('leave-requests', LeaveRequestController::class);
    Route::resource('compensatory-day-requests', CompensatoryDayRequestController::class);
});

// Manager Leave Requests access limited to: (Admin, Manager)
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/manager/leave-requests', [ManagerLeaveRequestController::class, 'index'])->name('manager-leave-requests.index');
    Route::get('/manager/leave-requests/{leaveRequest}', [ManagerLeaveRequestController::class, 'show'])->name('manager-leave-requests.show');
    Route::post('/manager/leave-requests/{leaveRequest}/approve', [ManagerLeaveRequestController::class, 'approve'])->name('manager-leave-requests.approve');
    Route::post('/manager/leave-requests/{leaveRequest}/reject', [ManagerLeaveRequestController::class, 'reject'])->name('manager-leave-requests.reject');
});

// HR Leave Requests access limited to: (Admin, HR)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    Route::get('/hr-leave-requests', [HRLeaveRequestController::class, 'index'])->name('hr-leave-requests.index');
    Route::get('/hr-leave-requests/{leaveRequest}', [HRLeaveRequestController::class, 'show'])->name('hr-leave-requests.show');
    Route::post('/hr-leave-requests/{leaveRequest}/approve', [HRLeaveRequestController::class, 'approve'])->name('hr-leave-requests.approve');
    Route::post('/hr-leave-requests/{leaveRequest}/reject', [HRLeaveRequestController::class, 'reject'])->name('hr-leave-requests.reject');
});

// Profile access limited to: (HR, Manager, Employee)
Route::middleware(['auth', 'role:hr,manager,employee'])->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');
});


require __DIR__.'/auth.php';
