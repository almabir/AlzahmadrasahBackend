@extends('layouts.dashboard')

@section('content')
<a href="{{ route('admin.users.create') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
    Add User
</a>
<hr>
<div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
    
    <div>
        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Users</h3>
        <p class="text-slate-500 dark:text-slate-400">Overview of the current users.</p>
    </div>
    <div class="ml-3">
        <div class="w-full max-w-sm min-w-[200px] relative">
            <div class="relative">
                <input
                    class="bg-white dark:bg-slate-700 w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 dark:text-slate-200 text-sm border border-slate-200 dark:border-slate-600 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    placeholder="Search for user..."
                />
                <button
                    class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white dark:bg-slate-700 rounded"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600 dark:text-slate-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.107m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
            <tr>
                <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                        Name
                    </p>
                </th>
                <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                        Email
                    </p>
                </th>
                <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">
                        Roles
                    </p>
                </th>
                <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400 text-right">
                        Actions
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                    <td class="p-4 py-3">
                        <p class="block font-semibold text-sm text-slate-800 dark:text-slate-200">{{ $user->name }}</p>
                    </td>
                    <td class="p-4 py-3">
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                    </td>
                    <td class="p-4 py-3">
                        @foreach ($user->roles as $role)
                            <span class="px-2 py-1 bg-gray-200 dark:bg-slate-700 dark:text-slate-200 rounded">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="p-4 py-3 text-right">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                        class="rounded-md bg-green-600 dark:bg-green-700 py-1 px-2 border border-transparent text-center text-sm text-white dark:text-slate-200 transition-all shadow-md hover:shadow-lg focus:bg-green-700 dark:focus:bg-green-800 focus:shadow-none active:bg-green-700 dark:active:bg-green-800 hover:bg-green-700 dark:hover:bg-green-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        >
                            Edit
                        </a>
                        <a href="{{ route('admin.users.permissions', $user) }}" 
                        class="rounded-md bg-amber-600 dark:bg-amber-700 py-1 px-2 border border-transparent text-center text-sm text-slate-800 dark:text-slate-200 transition-all shadow-md hover:shadow-lg focus:bg-amber-700 dark:focus:bg-amber-800 focus:shadow-none active:bg-amber-700 dark:active:bg-amber-800 hover:bg-amber-700 dark:hover:bg-amber-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        >
                            Permissions
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button 
                                class="rounded-md bg-red-600 dark:bg-red-700 py-1 px-2 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 dark:focus:bg-red-800 focus:shadow-none active:bg-red-700 dark:active:bg-red-800 hover:bg-red-700 dark:hover:bg-red-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" 
                                type="submit"
                                onclick="return confirm('Are you sure you want to delete this item?')"
                            >
                                Delete
                            </button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500 dark:text-slate-400">
            Showing <b>1-{{ count($users) }}</b> of {{ count($users) }}
        </div>
        <div class="flex space-x-1">
            <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-slate-400 dark:hover:border-slate-600 transition duration-200 ease">
                Prev
            </button>
            <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease">
                1
            </button>
            <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-slate-400 dark:hover:border-slate-600 transition duration-200 ease">
                Next
            </button>
        </div>
    
@endsection