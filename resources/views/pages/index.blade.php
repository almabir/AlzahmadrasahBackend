@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('pages.create') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
        Add New Page
    </a>
    <hr>
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Pages</h3>
            <p class="text-slate-500 dark:text-slate-400">Overview of the current pages and their subpages.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Title</p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Status</p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-right">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Actions</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                        <td class="p-4 py-3">
                            <p class="block font-semibold text-sm text-slate-800 dark:text-slate-200">{{ $page->title }}</p>
                        </td>
                        <td class="p-4 py-3">
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                @if ($page->status)
                                    <span class="px-2 py-1 bg-green-200 dark:bg-green-700 dark:text-green-200 rounded">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 dark:bg-red-700 dark:text-red-200 rounded">Inactive</span>
                                @endif
                            </p>
                        </td>
                        <td class="p-4 py-3 text-right">
                            <a href="{{ route('pages.edit', $page->id) }}" class="rounded-md bg-green-600 dark:bg-green-700 py-1 px-2 border border-transparent text-center text-sm text-white dark:text-slate-200 transition-all shadow-md hover:shadow-lg focus:bg-green-700 dark:focus:bg-green-800 hover:bg-green-700 dark:hover:bg-green-800">
                                Edit
                            </a>
                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md bg-red-600 dark:bg-red-700 py-1 px-2 border btn btn-sm border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 dark:focus:bg-red-800 hover:bg-red-700 dark:hover:bg-red-800 active:bg-red-700 dark:active:bg-red-800"
                                    onclick="return confirm('Are you sure you want to delete this page?')">
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
