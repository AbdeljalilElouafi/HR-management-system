@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Leave Requests</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Requested</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($leaveRequests as $leaveRequest)
                <tr>
                    <td class="px-6 py-4">{{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4">{{ $leaveRequest->days_requested }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-sm font-semibold rounded-full 
                            {{ $leaveRequest->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($leaveRequest->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($leaveRequest->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('manager-leave-requests.show', $leaveRequest->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        @if($leaveRequest->status === 'pending')
                            <form action="{{ route('manager-leave-requests.approve', $leaveRequest->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-500 hover:text-green-700 mr-2">Approve</button>
                            </form>
                            <form action="{{ route('manager-leave-requests.reject', $leaveRequest->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection