<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Notifications\LeaveRequestApprovedByManager;


class ManagerLeaveRequestController extends Controller
{
    
    public function index()
    {
        $manager = auth()->user()->employee;

        
        $leaveRequests = LeaveRequest::where('manager_id', $manager->id)
            ->with('employee')
            ->get();

        return view('manager-leave-requests.index', compact('leaveRequests'));
    }

    
    public function show(LeaveRequest $leaveRequest)
    {
        return view('manager-leave-requests.show', compact('leaveRequest'));
    }

    
    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'approved_by_manager',
            'manager_approval' => true,
        ]);
    
        // Notify HR
    //   $leaveRequest->hr->notify(new LeaveRequestApprovedByManager($leaveRequest));
    
        return redirect()->route('manager-leave-requests.index')->with('success', 'Leave request approved successfully.');
    }

    
    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'rejected']);

        return redirect()->route('manager-leave-requests.index')->with('success', 'Leave request rejected successfully.');
    }
}