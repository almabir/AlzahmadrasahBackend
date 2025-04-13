@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Create Donation Area</h3>
            <p class="text-slate-500 dark:text-slate-400">Create a new donation area.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('admin.donation-areas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('name') }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Image Field -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-5 text-sm btn btn-sm font-normal text-white bg-green-600 dark:bg-green-700 border border-green-600 dark:border-green-700 rounded hover:bg-green-700 dark:hover:bg-green-800 hover:border-green-700 dark:hover:border-green-800 transition duration-200 ease ml-2 focus:outline-none focus:ring focus:ring-green-300">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection