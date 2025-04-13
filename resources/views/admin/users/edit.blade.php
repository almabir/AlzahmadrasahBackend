@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit User</h3>
            <p class="text-slate-500 dark:text-slate-400">Edit an existing user.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-4">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200" value="{{ old('name', $user->name) }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200" value="{{ old('email', $user->email) }}">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password (Leave blank to keep current password)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="roles" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Roles</label>
                <select name="roles[]" id="roles" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection