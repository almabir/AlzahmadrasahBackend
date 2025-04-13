@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Settings</h1>
    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Company Name -->
        <div class="mb-6">
            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company Name</label>
            <input type="text" id="company_name" name="company_name" value="{{ $settings->company_name }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                   placeholder="Enter company name">
        </div>

        <!-- Address -->
        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
            <input type="text" id="address" name="address" value="{{ $settings->address }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                   placeholder="Enter address">
        </div>

        <!-- Mobile -->
        <div class="mb-6">
            <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mobile</label>
            <input type="text" id="mobile" name="mobile" value="{{ $settings->mobile }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                   placeholder="Enter mobile number">
        </div>

        <!-- Website -->
        <div class="mb-6">
            <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Website</label>
            <input type="url" id="website" name="website" value="{{ $settings->website }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                   placeholder="Enter website URL">
        </div>

        <!-- Logo -->
        <div class="mb-6">
            <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo</label>
            <input type="file" id="logo" name="logo"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
            @if ($settings->logo)
                <img src="{{ asset($settings->logo) }}" width="120" alt="Logo" class="mt-4 w-24 h-24 rounded-lg object-cover">
            @endif
        </div>

        <!-- Feature Image 1 -->
        <div class="mb-6">
            <label for="feature_image_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Feature Image 1</label>
            <input type="file" id="feature_image_1" name="feature_image_1"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
            @if ($settings->feature_image_1)
                <img src="{{ asset($settings->feature_image_1) }}" width="120" alt="Feature Image 1" class="mt-4 w-24 h-24 rounded-lg object-cover">
            @endif
        </div>

        <!-- Feature Image 2 -->
        <div class="mb-6">
            <label for="feature_image_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Feature Image 2</label>
            <input type="file" id="feature_image_2" name="feature_image_2"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
            @if ($settings->feature_image_2)
                <img src="{{ asset($settings->feature_image_2) }}" width="120" alt="Feature Image 2" class="mt-4 w-24 h-24 rounded-lg object-cover">
            @endif
        </div>

        <!-- Feature Image 3 -->
        <div class="mb-6">
            <label for="feature_image_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Feature Image 3</label>
            <input type="file" id="feature_image_3" name="feature_image_3"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
            @if ($settings->feature_image_3)
                <img src="{{ asset($settings->feature_image_3) }}" width="120" alt="Feature Image 3" class="mt-4 w-24 h-24 rounded-lg object-cover">
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-8">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                Update Settings
            </button>
        </div>
    </form>
</div>
@endsection