@extends('layouts.app')

@section('content')
<!-- Career Path Section -->
<div class="md:col-span-2 mt-6 mb-6">
    <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
        Career Path
    </h2>
</div>

<div class="space-y-4">
    @foreach ($employee->careerChanges as $change)
        <div class="flex items-start space-x-4">
            <!-- Timeline Dot -->
            <div class="flex-shrink-0 w-4 h-4 bg-blue-500 rounded-full mt-2"></div>
            
            <!-- Event Details -->
            <div class="flex-1">
                <div class="text-sm font-medium text-gray-700">
                    {{ ucfirst($change->type) }} - {{ $change->title ?? 'N/A' }}
                </div>
                <div class="text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($change->change_date)->format('M d, Y') }}
                </div>
                @if ($change->department)
                    <div class="text-sm text-gray-600">
                        Department: {{ $change->department->name }}
                    </div>
                @endif
                @if ($change->salary)
                    <div class="text-sm text-gray-600">
                        Salary: ${{ number_format($change->salary, 2) }}
                    </div>
                @endif
                @if ($change->description)
                    <div class="text-sm text-gray-600">
                        {{ $change->description }}
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- Add Career Change Form -->
<div class="mt-8">
    <h2 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 mb-4">
        Add Career Change
    </h2>
    <form action="{{ route('employees.addCareerChange', $employee->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select name="type" id="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="promotion">Promotion</option>
                <option value="role_change">Role Change</option>
                <option value="department_transfer">Department Transfer</option>
            </select>
        </div>
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
            <input type="number" name="salary" id="salary" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="change_date" class="block text-sm font-medium text-gray-700">Change Date</label>
            <input type="date" name="change_date" id="change_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Add Career Change</button>
        </div>
    </form>
</div>
@endsection
