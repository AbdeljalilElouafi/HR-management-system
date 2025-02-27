@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Departments</h1>
    <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Add Department</a>

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($departments as $department)
                <tr>
                    <td class="px-6 py-4">{{ $department->name }}</td>
                    <td class="px-6 py-4">{{ $department->description ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $department->company->name }}</td>
                    <td class="px-6 py-4">
                        @if ($department->manager)
                            {{ $department->manager->first_name }} {{ $department->manager->last_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('departments.show', $department->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        <a href="{{ route('departments.edit', $department->id) }}" class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection