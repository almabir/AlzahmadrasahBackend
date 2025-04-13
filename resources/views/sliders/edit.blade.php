@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit Slider Item</h3>
            <p class="text-slate-500 dark:text-slate-400">Modify the details of the slider item.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('admin.slider.update', $sliderItem) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('title', $sliderItem->title) }}" placeholder="Enter title">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="sub_title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sub-Title (Optional)</label>
                <input type="text" name="sub_title" id="sub_title" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('sub_title', $sliderItem->sub_title) }}" placeholder="Enter sub-title">
                @error('sub_title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link (Optional)</label>
                <input type="text" name="link" id="link" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('link', $sliderItem->link) }}" placeholder="Enter link">
                @error('link') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" placeholder="Choose image">
                @if ($sliderItem->image_url)
                    <img src="{{ url($sliderItem->image_url) }}" alt="{{ $sliderItem->title }}" class="mt-2 w-20 h-auto rounded">
                @endif
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-blue-600 dark:bg-blue-700 border border-blue-600 dark:border-blue-700 rounded hover:bg-blue-700 dark:hover:bg-blue-800 hover:border-blue-700 dark:hover:border-blue-800 transition duration-200 ease ml-2 focus:outline-none focus:ring focus:ring-blue-300">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection