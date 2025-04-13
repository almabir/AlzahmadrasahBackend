@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('galleries.create') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
        Add Gallery Item
    </a><hr>
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Gallery Items</h3>
            <p class="text-slate-500 dark:text-slate-400">Manage gallery items.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                            Image
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                            Title
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                            Category
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-right">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                            Actions
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galleries as $gallery)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                        <td class="p-4 py-2">
                            @if($gallery->image_url)
                                <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <span class="text-sm text-slate-500 dark:text-slate-400">No Image</span>
                            @endif
                        </td>
                        <td class="p-4 py-2">
                            <p class="block font-semibold text-sm text-slate-800 dark:text-slate-200">{{ $gallery->title }}</p>
                        </td>
                        <td class="p-4 py-2">
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $gallery->categoryName->name }}</p>
                        </td>
                        <td class="p-4 py-2 text-right">
                            <a href="{{ route('galleries.edit', $gallery->id) }}"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-green-600 dark:bg-green-700 border border-green-600 dark:border-green-700 rounded hover:bg-green-700 dark:hover:bg-green-800 hover:border-green-700 dark:hover:border-green-800 transition duration-200 ease ml-2"
                            >
                                Edit
                            </a>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="px-3 py-1 min-w-9 min-h-5 text-sm btn btn-sm font-normal text-white bg-red-600 dark:bg-red-700 border border-red-600 dark:border-red-700 rounded hover:bg-red-700 dark:hover:bg-red-800 hover:border-red-700 dark:hover:border-red-800 transition duration-200 ease ml-2"
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this gallery item?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection