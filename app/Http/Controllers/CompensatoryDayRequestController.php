<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompensatoryDayRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compensatoryDayRequests = CompensatoryDayRequest::where('employee_id', auth()->user()->employee->id)->get();
        return view('compensatory-day-requests.index', compact('compensatoryDayRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('compensatory-day-requests.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        CompensatoryDayRequest::create([
            'employee_id' => auth()->user()->employee->id,
            'date' => $request->date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('compensatory-day-requests.index')->with('success', 'Compensatory day request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompensatoryDayRequest $compensatoryDayRequest)
    {
        return view('compensatory-day-requests.show', compact('compensatoryDayRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
