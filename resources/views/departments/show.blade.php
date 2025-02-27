@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Department Details</h1>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <p class="mt-1 text-lg">{{ $department->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <p class="mt-1 text-lg">{{ $department->description ?? 'N/A' }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Company</label>
            <p class="mt-1 text-lg">{{ $department->company->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Manager</label>
            <p class="mt-1 text-lg">
                @if ($department->manager)
                    {{ $department->manager->first_name }} {{ $department->manager->last_name }}
                @else
                    N/A
                @endif
            </p>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('departments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300">Back</a>
        </div>
    </div>
</div>
@endsection