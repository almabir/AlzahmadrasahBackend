@extends('layouts.dashboard')

@section('content')
    <div class="w-full max-w-3xl mx-auto bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-200 mb-4">Edit Director</h2>
        
        <form action="{{ route('directors.update', $director->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $director->name) }}" 
                       class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                       placeholder="Enter full name" required>
            </div>

            {{-- Mobile --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Mobile</label>
                <input type="text" name="mobile" value="{{ old('mobile', $director->mobile) }}" 
                       class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                       placeholder="Enter mobile number">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $director->email) }}" 
                       class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                       placeholder="Enter email" required>
            </div>

            {{-- Post --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Post</label>
                <input type="text" name="post" value="{{ old('post', $director->post) }}" 
                       class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                       placeholder="Enter post title" required>
            </div>

            {{-- Category Dropdown --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Category</label>
                <select name="category" 
                        class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200" required>
                    <option value="Board of Director" {{ old('category', $director->category) == 'Board of Director' ? 'selected' : '' }}>Board of Director</option>
                    <option value="Deputy Director" {{ old('category', $director->category) == 'Deputy Director' ? 'selected' : '' }}>Deputy Director</option>
                    <option value="Shariah Team" {{ old('category', $director->category) == 'Shariah Team' ? 'selected' : '' }}>Shariah Team</option>
                    <option value="Editor" {{ old('category', $director->category) == 'Editor' ? 'selected' : '' }}>Editor</option>
                </select>
            </div>

            {{-- About --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">About</label>
                <textarea name="about" rows="3" 
                          class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                          placeholder="Write about the director...">{{ old('about', $director->about) }}</textarea>
            </div>

            {{-- Speech --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Speech</label>
                <textarea name="speech" rows="3" 
                          class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                          placeholder="Write a speech...">{{ old('speech', $director->speech) }}</textarea>
            </div>

            {{-- Social Links --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Social Links (JSON format)</label>
                <input type="text" name="social_links" value="{{ old('social_links', json_encode($director->social_links)) }}" 
                       class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200"
                       placeholder='Example: {"facebook":"url", "linkedin":"url"}'>
            </div>

            {{-- Image Upload --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">Profile Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200">
                @if ($director->image)
                    <img src="{{ asset($director->image) }}" class="mt-2 w-32 h-32 object-cover rounded">
                @endif
            </div>

            {{-- CV Upload --}}
            <div class="mb-4">
                <label class="block text-slate-700 dark:text-slate-300 mb-1">CV (PDF)</label>
                <input type="file" name="cv" class="w-full p-2 border rounded bg-gray-100 dark:bg-slate-700 text-slate-900 dark:text-slate-200">
                @if ($director->cv)
                    <p class="mt-2 text-slate-500 dark:text-slate-400">
                        <a href="{{ asset($director->cv) }}" target="_blank" class="text-blue-500 hover:underline">View Current CV</a>
                    </p>
                @endif
            </div>

            {{-- Submit Button --}}
            <div class="mt-4">
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                    Update Director
                </button>
                <a href="{{ route('directors.index') }}" 
                   class="px-4 py-2 ml-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
