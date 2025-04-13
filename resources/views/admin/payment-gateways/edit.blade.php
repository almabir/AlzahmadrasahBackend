@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit Payment Gateway</h3>
            <p class="text-slate-500 dark:text-slate-400">Edit an existing payment gateway.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('admin.payment-gateways.update', $paymentGateway) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('name', $paymentGateway->name) }}">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="api_key" class="block text-sm font-medium text-slate-700 dark:text-slate-300">API Key</label>
                <input type="text" name="api_key" id="api_key" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('api_key', $paymentGateway->api_key) }}">
                @error('api_key') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="api_secret" class="block text-sm font-medium text-slate-700 dark:text-slate-300">API Secret</label>
                <input type="text" name="api_secret" id="api_secret" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('api_secret', $paymentGateway->api_secret) }}">
                @error('api_secret') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="is_active" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Active</label>
                <select name="is_active" id="is_active" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">
                    <option value="1" {{ old('is_active', $paymentGateway->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_active', $paymentGateway->is_active) == 0 ? 'selected' : '' }}>No</option>
                </select>
                @error('is_active') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="config" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Configuration (JSON)</label>
                <textarea name="config" id="config" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">{{ old('config', json_encode($paymentGateway->config, JSON_PRETTY_PRINT)) }}</textarea>
                @error('config') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-green-600 dark:bg-green-700 border border-green-600 dark:border-green-700 rounded hover:bg-green-700 dark:hover:bg-green-800 hover:border-green-700 dark:hover:border-green-800 transition duration-200 ease ml-2 focus:outline-none focus:ring focus:ring-green-300">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection