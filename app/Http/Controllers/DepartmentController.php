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
        $departments = Department::with('company', 'manager')->get();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $managers = Employee::all();
        return view('departments.create', compact('companies', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:employees,id',
            'company_id' => 'required|exists:companies,id',
        ]);

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
