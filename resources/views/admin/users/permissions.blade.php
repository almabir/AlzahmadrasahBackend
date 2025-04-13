@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit User Permissions</h3>
            <p class="text-slate-500 dark:text-slate-400">Edit permissions for an existing user.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-4">
        <form action="{{ route('admin.users.permissions.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Permissions</label>
                <div class="mt-2">
                    @foreach($permissions as $permission)
                        <div class="flex items-center mb-2">
                            <input id="permission-{{ $permission->id }}" name="permissions[]" type="checkbox" value="{{ $permission->name }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border border-slate-300 dark:border-slate-600 rounded bg-white dark:bg-slate-700"
                                {{ $user->permissions->contains($permission) ? 'checked' : '' }}>
                            <label for="permission-{{ $permission->id }}" class="ml-3 block text-sm text-slate-700 dark:text-slate-300">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('permissions') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease">
                    Update Permissions
                </button>
            </div>
        </form>
    </div>
@endsection