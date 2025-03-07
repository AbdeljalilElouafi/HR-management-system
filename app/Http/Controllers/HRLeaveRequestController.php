<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class HRLeaveRequestController extends Controller
{
    public function index()
    {
        $hr = auth()->user()->employee;

        $leaveRequests = LeaveRequest::where('hr_id', $hr->id)
            ->where('manager_approval', true)
            ->with('employee')
            ->get();

        return view('hr-leave-requests.index', compact('leaveRequests'));
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'approved',
            'hr_approval' => true,
        ]);

        // Deduct leave balance
        $employee = $leaveRequest->employee;
        $employee->leave_balance -= $leaveRequest->days_requested;
        $employee->save();

        return redirect()->route('hr-leave-requests.index')->with('success', 'Leave request approved successfully.');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'rejected',
            'hr_approval' => false,
        ]);

        return redirect()->route('hr-leave-requests.index')->with('success', 'Leave request rejected successfully.');
    }
}
