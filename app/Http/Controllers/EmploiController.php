<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi;
use App\Models\Department;
use App\Models\Company;


class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;
        $emplois = Emploi::where('company_id', $companyId)->with('department')->get();
        return view('emplois.index', compact('emplois'));
    }
    
    public function create()
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        return view('emplois.create', compact('departments'));
    }
    
    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
        ]);
    
        // Add the company_id to the request data
        $request->merge(['company_id' => $companyId]);
    
        Emploi::create($request->all());
    
        return redirect()->route('emplois.index')->with('success', 'Emploi created successfully.');
    }

    // Show a specific emploi
    public function show(Emploi $emploi)
    {
        return view('emplois.show', compact('emploi'));
    }

    // Show the form to edit an emploi
    public function edit(Emploi $emploi)
    {
        $departments = Department::all();
        return view('emplois.edit', compact('emploi', 'departments'));
    }

    // Update an emploi
    public function update(Request $request, Emploi $emploi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
        ]);

        $emploi->update($request->all());

        return redirect()->route('emplois.index')->with('success', 'Emploi updated successfully.');
    }

    // Delete an emploi
    public function destroy(Emploi $emploi)
    {
        $emploi->delete();
        return redirect()->route('emplois.index')->with('success', 'Emploi deleted successfully.');
    }
}
