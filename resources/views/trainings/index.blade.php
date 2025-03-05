@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Trainings</h1>
    <a href="{{ route('trainings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Add Training</a>

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($trainings as $training)
                <tr>
                    <td class="px-6 py-4">{{ $training->title }}</td>
                    <td class="px-6 py-4">{{ $training->department ? $training->department->name : 'N/A' }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($training->start_date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($training->end_date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('trainings.show', $training->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        <a href="{{ route('trainings.edit', $training->id) }}" class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                        <form action="{{ route('trainings.destroy', $training->id) }}" method="POST" class="inline">
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