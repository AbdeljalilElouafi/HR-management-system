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
                Edit Employee Details
            </h1>
            <p class="mt-1 text-blue-100 text-sm">Update the employee information below</p>
        </div>
        
        <!-- Form content -->
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Form sections with grid layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information Section -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
                        Personal Information
                    </h2>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ old('address', $employee->address) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                
                <!-- Employment Details Section -->
                <div class="md:col-span-2 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
                        Employment Details
                    </h2>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                        <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="salary" value="{{ old('salary', $employee->salary) }}" class="pl-7 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                    </div>
                    

                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="contract_type" class="block text-sm font-medium text-gray-700">Contract Type</label>
                        <select name="contract_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="Full-time" {{ $employee->contract_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ $employee->contract_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ $employee->contract_type == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ $employee->contract_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="Active" {{ $employee->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="On Leave" {{ $employee->status == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                            <option value="Probation" {{ $employee->status == 'Probation' ? 'selected' : '' }}>Probation</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="employee" {{ $employee->user->hasRole('employee') ? 'selected' : '' }}>Employee</option>
                            <option value="manager" {{ $employee->user->hasRole('manager') ? 'selected' : '' }}>Manager</option>
                            <option value="hr" {{ $employee->user->hasRole('hr') ? 'selected' : '' }}>HR</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                        <select name="department_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Submit Button Section -->
            <div class="mt-8 pt-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('employees.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 relative group">
                        <span>Save Changes</span>
                        <span class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
