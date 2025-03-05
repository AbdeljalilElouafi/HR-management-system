<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class OrganigrammeController extends Controller
{
    public function index()
    {
        // Get the logged-in user's company ID
        $companyId = auth()->user()->company_id;

        // Fetch the hierarchical data
        $employees = Employee::getHierarchy($companyId);

        return view('organigramme.index', compact('employees'));
    }
}