<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; 
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeAccountCreated;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user's company ID
        $companyId = auth()->user()->company_id;
    
        // Fetch employees for the user's company
        $employees = Employee::where('company_id', $companyId)->with('department')->get();
        return view('employees.index', compact('employees'));
    }
    
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        return view('employees.create', compact('departments'));
    }
    
    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'address' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'status' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
        ]);
    
        // Add the company_id to the request data
        $request->merge(['company_id' => $companyId]);
    
        Employee::create($request->all());
    
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'companies', 'departments'));
    }


    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'address' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'status' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
