@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('pages.index') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
        Back to Pages
    </a>

    <hr>

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Create New Page</h3>
            <p class="text-slate-500 dark:text-slate-400">Fill in the details to create a new page along with its subpages.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">

        <form action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="px-4 py-5 space-y-4">
                <!-- Page Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter page title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Page Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Enter page slug (e.g., my-page)" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('slug')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Page Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Content</label>
                    <textarea name="content" id="content" rows="4" placeholder="Enter page content (HTML or plain text)" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- SEO Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-slate-700 dark:text-slate-200">SEO Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="Enter SEO title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- SEO Description -->
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-slate-700 dark:text-slate-200">SEO Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" placeholder="Enter SEO description" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('meta_description') }}</textarea>
                </div>

                <!-- SEO Keywords -->
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-slate-700 dark:text-slate-200">SEO Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Enter SEO keywords, separated by commas" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Subpages Section -->
                <div id="subpages-section">
                    <h2 class="text-xl font-medium text-red-700 dark:text-slate-200 mt-6 mb-6">Sub-Pages</h2><hr>
                    <div class="space-y-4" id="subpages-container">
                        <!-- Initial Subpage Field -->
                        <div class="subpage-entry">
                            <div class="flex flex-col space-y-4">
                                <div>
                                    <label for="subpage_title" class="block text-sm font-medium text-slate-700 dark:text-slate-200 ">Subpage Title</label>
                                    <input type="text" name="subpages[0][title]" placeholder="Enter subpage title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="subpage_slug" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Sub Title</label>
                                    <input type="text" name="subpages[0][slug]" placeholder="Enter Subpage Sub Title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="subpage_description" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Description</label>
                                    <textarea name="subpages[0][description]" placeholder="Enter subpage description" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                                </div>
                                <div>
                                    <label for="subpage_thumbnail" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Thumbnail</label>
                                    <input type="text" name="subpages[0][thumbnail]" placeholder="Enter thumbnail URL" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <button type="button" class="bg-red-600 text-white rounded-md px-2 py-1 mt-2" onclick="removeSubpage(this)">Remove</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="mt-2 text-blue-600 " onclick="addSubpage()">Add Subpage</button>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Create Page</button>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        // Add Subpage Fields Dynamically
        let subpageIndex = 1;

        function addSubpage() {
            const container = document.getElementById('subpages-container');
            const subpageHTML = `
                <div class="subpage-entry">
                    <div class="flex flex-col space-y-4">
                        <div>
                            <label for="subpage_title" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Title</label>
                            <input type="text" name="subpages[${subpageIndex}][title]" placeholder="Enter subpage title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_slug" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Slug</label>
                            <input type="text" name="subpages[${subpageIndex}][slug]" placeholder="Enter subpage slug" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_description" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Description</label>
                            <textarea name="subpages[${subpageIndex}][description]" placeholder="Enter subpage description" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                        </div>
                        <div>
                            <label for="subpage_thumbnail" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Thumbnail</label>
                            <input type="text" name="subpages[${subpageIndex}][thumbnail]" placeholder="Enter thumbnail URL" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button type="button" class="bg-red-600 text-white rounded-md px-2 py-1 mt-2" onclick="removeSubpage(this)">Remove</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', subpageHTML);
            subpageIndex++;
        }

        function removeSubpage(button) {
            const subpageEntry = button.closest('.subpage-entry');
            subpageEntry.remove();
        }
    </script>

    <!-- [Your content here] -->
@endsection