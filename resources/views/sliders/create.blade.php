@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Create Slider Item</h3>
            <p class="text-slate-500 dark:text-slate-400">Add a new item to the slider.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('title') }}" placeholder="Enter title">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="sub_title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sub-Title (Optional)</label>
                <input type="text" name="sub_title" id="sub_title" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('sub_title') }}" placeholder="Enter sub-title">
                @error('sub_title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link (Optional)</label>
                <input type="text" name="link" id="link" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('link') }}" placeholder="Enter link">
                @error('link') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" placeholder="Choose image">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-green-600 dark:bg-green-700 border border-green-600 dark:border-green-700 rounded hover:bg-green-700 dark:hover:bg-green-800 hover:border-green-700 dark:hover:border-green-800 transition duration-200 ease ml-2 focus:outline-none focus:ring focus:ring-green-300">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection