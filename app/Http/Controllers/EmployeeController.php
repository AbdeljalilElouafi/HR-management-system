<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; 
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Spatie\Permission\Models\Role;
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

        $managers = Employee::whereHas('user', function ($query) use ($companyId) {
            $query->where('company_id', $companyId)
                  ->whereHas('roles', function ($query) {
                      $query->where('name', 'manager');
                  });
        })->get();
    
        return view('employees.create', compact('departments', 'managers'));
    }
    
    public function store(Request $request)
    {
        // dd('died here');
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
            'role' => 'required|in:employee,manager,hr', // Validate the role
        ]);

        $request->merge(['company_id' => $companyId]);
        // Create the user
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password'), 
            'company_id' => $companyId,
        ]);
    
        
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'hire_date' => $request->hire_date,
            'address' => $request->address,
            'contract_type' => $request->contract_type,
            'salary' => $request->salary,
            'status' => $request->status,
            'department_id' => $request->department_id,
            'user_id' => $user->id, 
            'company_id' => $companyId,
            'manager_id' => $request->manager_id,
        ]);
    
        // Assign the selected role to the user
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
        }

        $leaveBalance = $employee->calculateAnnualLeaveDays();
        $employee->leaveBalance()->create([
            'annual_leave_days' => $leaveBalance,
            'compensatory_days' => 0, 
        ]);
    
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

        $companyId = auth()->user()->company_id;

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
            'department_id' => 'nullable|exists:departments,id',
            'role' => 'required|in:employee,manager,hr',
        ]);

        
        $request->merge(['company_id' => $companyId]);
        
        $employee->update($request->all());

        // Assign the selected role to the employee
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $employee->user->assignRole($role);
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }


    public function addCareerChange(Request $request, Employee $employee)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'salary' => 'nullable|numeric',
            'change_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $employee->careerChanges()->create($request->all());

        return redirect()->route('employees.show', $employee->id)->with('success', 'Career change added successfully.');
    }

}
