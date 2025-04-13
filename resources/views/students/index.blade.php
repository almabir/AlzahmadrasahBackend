@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Student Management</h3>
            <p class="text-slate-500 dark:text-slate-400">Manage student records</p>
        </div>
        <a href="{{ route('students.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Student</a>
    </div>

    <div class="relative overflow-x-auto bg-white dark:bg-slate-800 shadow-md rounded-lg p-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Mobile</th>
                    <th scope="col" class="px-6 py-3">Class</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4">{{ $student->email }}</td>
                        <td class="px-6 py-4">{{ $student->mobile }}</td>
                        <td class="px-6 py-4">{{ $student->academicClass->name ?? '-' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('students.show', $student->id) }}" class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
@endsection