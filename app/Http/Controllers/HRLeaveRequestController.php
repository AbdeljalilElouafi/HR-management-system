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
            ->where('hr_approval', false) // this clause is to show the requests not approved by hr
            ->with('employee')
            ->get();


            // dd($hr, $leaveRequests);
            // logger($leaveRequests);

        return view('hr-leave-requests.index', compact('leaveRequests'));
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'approved',
            'hr_approval' => true,
        ]);

        $leaveBalance = $leaveRequest->employee->leaveBalance;

        if ($leaveBalance) {
            $leaveBalance->annual_leave_days -= $leaveRequest->days_requested;
            $leaveBalance->save();
        } else {
            return redirect()->route('hr-leave-requests.index')->with('error', 'Leave balance not found for the employee.');
        }


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
