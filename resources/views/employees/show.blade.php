@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-500 min-h-screen p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with decorative elements -->
        <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 bg-yellow-300 w-20 h-20 rounded-full opacity-20"></div>
            <div class="absolute bottom-0 left-0 -mb-6 -ml-6 bg-blue-400 w-24 h-24 rounded-full opacity-20"></div>
            
            <h1 class="text-3xl font-bold relative z-10 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Employee Details
            </h1>
            <p class="mt-1 text-blue-100 text-sm">View the details of this employee</p>
        </div>
        
        <!-- Employee Details -->
        <div class="p-6">
            <!-- Personal Information Section -->
            <div class="md:col-span-2 mb-6">
                <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
                    Personal Information
                </h2>
            </div>
            
            <div class="space-y-4">
                <div>
                    <strong class="text-sm font-medium text-gray-700">First Name:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->first_name }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Last Name:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->last_name }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Email:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->email }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Date of Birth:</strong>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($employee->date_of_birth)->format('M d, Y') }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Phone:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->phone }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Address:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->address }}</p>
                </div>
            </div>

            <!-- Employment Details Section -->
            <div class="md:col-span-2 mt-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
                    Employment Details
                </h2>
            </div>
            
            <div class="space-y-4">
                <div>
                    <strong class="text-sm font-medium text-gray-700">Hire Date:</strong>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Salary:</strong>
                    <p class="text-sm text-gray-600">${{ number_format($employee->salary, 2) }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Company:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->company->name }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Contract Type:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->contract_type }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Status:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->status }}</p>
                </div>
                
                <div>
                    <strong class="text-sm font-medium text-gray-700">Department:</strong>
                    <p class="text-sm text-gray-600">{{ $employee->department ? $employee->department->name : 'N/A' }}</p>
                </div>
            </div>

            <!-- Back to List Button -->
            <div class="mt-8 pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('employees.index') }}" class="bg-indigo-600 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Back to Employee List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
