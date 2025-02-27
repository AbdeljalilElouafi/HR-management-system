@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Department</h1>
    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $department->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $department->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="company_id" class="block text-sm font-medium text-gray-700">Company</label>
            <select name="company_id" id="company_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $department->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager</label>
            <select name="manager_id" id="manager_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Manager</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}" {{ $department->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->first_name }} {{ $manager->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Update</button>
        </div>
    </form>
</div>
@endsection