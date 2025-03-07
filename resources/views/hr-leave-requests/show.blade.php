@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Leave Request Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="space-y-4">
            <div>
                <strong class="text-sm font-medium text-gray-700">Employee:</strong>
                <p class="text-sm text-gray-600">{{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}</p>
            </div>
            <div>
                <strong class="text-sm font-medium text-gray-700">Start Date:</strong>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('M d, Y') }}</p>
            </div>
            <div>
                <strong class="text-sm font-medium text-gray-700">End Date:</strong>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('M d, Y') }}</p>
            </div>
            <div>
                <strong class="text-sm font-medium text-gray-700">Days Requested:</strong>
                <p class="text-sm text-gray-600">{{ $leaveRequest->days_requested }}</p>
            </div>
            <div>
                <strong class="text-sm font-medium text-gray-700">Reason:</strong>
                <p class="text-sm text-gray-600">{{ $leaveRequest->reason }}</p>
            </div>
            <div>
                <strong class="text-sm font-medium text-gray-700">Status:</strong>
                <p class="text-sm text-gray-600">
                    <span class="px-2 py-1 text-sm font-semibold rounded-full 
                        {{ $leaveRequest->status === 'approved' ? 'bg-green-100 text-green-800' : 
                           ($leaveRequest->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($leaveRequest->status) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('hr-leave-requests.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Back</a>
        </div>
    </div>
</div>
@endsection