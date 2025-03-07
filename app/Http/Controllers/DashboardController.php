<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\LeaveRequest;

class DashboardController extends Controller
{
    public function index()
    {
        
        $companyId = auth()->user()->company_id;

        
        $totalEmployees = Employee::where('company_id', $companyId)->count();

        
        $employeesPerDepartment = Department::where('company_id', $companyId)
            ->withCount(['employees' => function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            }])
            ->get();

        
        $averageSalary = Employee::where('company_id', $companyId)->avg('salary');

        return view('dashboard', compact(
            'totalEmployees',
            'employeesPerDepartment',
            'averageSalary'
        ));
    }

}