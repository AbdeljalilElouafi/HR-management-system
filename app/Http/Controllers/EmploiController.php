<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emplois = Emploi::with('department')->get();
        return view('emplois.index', compact('emplois'));
    }

    // Show the form to create a new emploi
    public function create()
    {
        $departments = Department::all();
        return view('emplois.create', compact('departments'));
    }

    // Store a new emploi
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
        ]);

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
