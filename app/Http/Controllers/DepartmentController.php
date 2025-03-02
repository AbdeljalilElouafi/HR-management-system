<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        return view('departments.index', compact('departments'));
    }
    
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $managers = Employee::where('company_id', $companyId)->get();
        return view('departments.create', compact('managers'));
    }
    
    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:employees,id',
        ]);
    
        // Add the company_id to the request data
        $request->merge(['company_id' => $companyId]);
    
        Department::create($request->all());
    
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $companies = Company::all();
        $managers = Employee::all();
        return view('departments.edit', compact('department', 'companies', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:employees,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete(); // Soft delete the department
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    /**
     * Restore a soft-deleted department.
     */
    public function restore($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->restore();

        return redirect()->route('departments.index')->with('success', 'Department restored successfully.');
    }

    /**
     * Permanently delete a department.
     */
    public function forceDelete($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->forceDelete();

        return redirect()->route('departments.index')->with('success', 'Department permanently deleted.');
    }
}
