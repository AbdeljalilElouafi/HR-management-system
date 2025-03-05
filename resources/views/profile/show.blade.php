@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Editable Information -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Editable Information</h3>
                    <form action="{{ route('profile.update-info') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" name="address" id="address" value="{{ auth()->user()->employee->address }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ auth()->user()->employee->phone }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Non-Editable Information -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Non-Editable Information</h3>
                    <div class="space-y-4">
                        <div>
                            <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">Name:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->employee->first_name }} {{ auth()->user()->employee->last_name }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">Email:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">Hire Date:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse(auth()->user()->employee->hire_date)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave and Compensatory Days Balance -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Leave and Compensatory Days Balance</h3>
                    <div class="space-y-4">
                        <div>
                            <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">Annual Leave Days:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->employee->leaveBalance->annual_leave_days ?? 0 }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-700 dark:text-gray-300">Compensatory Days:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->employee->leaveBalance->compensatory_days ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave Request Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Request Leave</h3>
                    <form action="{{ route('leave-requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                        </div>
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason</label>
                            <textarea name="reason" id="reason"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Compensatory Day Request Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Request Compensatory Day</h3>
                    <form action="{{ route('compensatory-day-requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" name="date" id="date"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                        </div>
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason</label>
                            <textarea name="reason" id="reason"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection