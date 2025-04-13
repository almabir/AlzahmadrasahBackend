@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Add New Academic Class</h3>
            <p class="text-slate-500 dark:text-slate-400">Fill in the details to create a new academic class.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('academic-classes.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Class Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('name') }}" placeholder="Enter class name" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create Class</button>
            </div>
        </form>
    </div>
@endsection