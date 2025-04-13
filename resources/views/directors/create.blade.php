@extends('layouts.dashboard')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-200 mb-4">Add New Director</h2>

        <form action="{{ route('directors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" name="name" placeholder="Enter director's name" required
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Profile Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Mobile -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Mobile</label>
                <input type="text" name="mobile" placeholder="Enter mobile number"
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                <input type="email" name="email" placeholder="Enter email address" required
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Post -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Post</label>
                <input type="text" name="post" placeholder="Enter director's post" required
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- About -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">About</label>
                <textarea name="about" placeholder="Write a short biography..." rows="3"
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400"></textarea>
            </div>

            <!-- Social Links -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Social Links (JSON Format)</label>
                <input type="text" name="social_links" placeholder='e.g., {"facebook": "https://fb.com/name"}'
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Speech -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Speech</label>
                <textarea name="speech" placeholder="Enter director's speech..." rows="3"
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400"></textarea>
            </div>

            <!-- CV Upload -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Upload CV (PDF)</label>
                <input type="file" name="cv" accept=".pdf"
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
            </div>

            <!-- Category (Dropdown) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Category</label>
                <select name="category" required
                    class="w-full p-2 mt-1 text-sm border rounded-lg bg-gray-50 dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-200 focus:ring focus:ring-slate-400">
                    <option value="" disabled selected>Select Category</option>
                    <option value="Board of Director">Board of Director</option>
                    <option value="Deputy Director">Deputy Director</option>
                    <option value="Shariah Team">Shariah Team</option>
                    <option value="Editor">Editor</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                    Save Director
                </button>
            </div>
        </form>
    </div>
@endsection
