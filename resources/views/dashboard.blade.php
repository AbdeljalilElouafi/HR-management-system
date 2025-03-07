@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- Statistics Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        <!-- Total Employees -->
                        <div class="bg-blue-300 p-6 rounded-lg shadow-md">
                            <h4 class="text-md font-medium text-blue-800">Total Employees</h4>
                            <p class="text-2xl font-bold text-blue-900">{{ $totalEmployees }}</p>
                        </div>

                        <!-- Employees Per Department -->
                        <div class="bg-green-300 p-6 rounded-lg shadow-md">
                            <h4 class="text-md font-medium text-green-800">Employees Per Department</h4>
                            <ul class="list-disc list-inside">
                                @foreach ($employeesPerDepartment as $department)
                                    <li class="text-green-900">{{ $department->name }}: {{ $department->employees_count }}</li>
                                @endforeach
                            </ul>
                        </div>



                        <!-- Average Salary -->
                        <div class="bg-yellow-300 p-6 rounded-lg shadow-md">
                            <h4 class="text-md font-medium text-yellow-800">Average Salary</h4>
                            <p class="text-2xl font-bold text-yellow-900">${{ number_format($averageSalary, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
