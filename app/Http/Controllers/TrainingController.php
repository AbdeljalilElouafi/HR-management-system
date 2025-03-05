<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Department;
use App\Models\Company;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    // List all trainings
    public function index()
    {
        $trainings = Training::where('company_id', auth()->user()->company_id)->get();
        return view('trainings.index', compact('trainings'));
    }

    // Show the form to create a new training
    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)->get();
        return view('trainings.create', compact('departments'));
    }

    // Store a new training
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        // Add the company_id to the request data
        $request->merge(['company_id' => auth()->user()->company_id]);

        Training::create($request->all());

        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    // Show a specific training
    public function show(Training $training)
    {
        return view('trainings.show', compact('training'));
    }

    // Show the form to edit a training
    public function edit(Training $training)
    {
        $departments = Department::where('company_id', auth()->user()->company_id)->get();
        return view('trainings.edit', compact('training', 'departments'));
    }

    // Update a training
    public function update(Request $request, Training $training)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $training->update($request->all());

        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    // Delete a training
    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}