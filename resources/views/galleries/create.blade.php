@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Create Gallery Item</h3>
            <p class="text-slate-500 dark:text-slate-400">Add a new gallery item.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">
        <div class="p-6">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter title" class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-slate-200">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image:</label>
                    <input type="file" name="image" id="image" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-slate-200">
                </div>
                <div class="mb-4">
                    <label for="gallery_category_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Category:</label>
                    <select name="gallery_category_id" id="gallery_category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-slate-200">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-slate-800 dark:bg-slate-600 text-white rounded hover:bg-slate-600 dark:hover:bg-slate-500 transition duration-200 ease">Create</button>
                    <a href="{{ route('galleries.index') }}" class="ml-2 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200 ease">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection