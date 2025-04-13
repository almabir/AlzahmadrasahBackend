@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('pages.index') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
        Back to Pages
    </a>
    <hr>

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit Page</h3>
            <p class="text-slate-500 dark:text-slate-400">Modify the page details and its subpages.</p>
        </div>
    </div>

    <form action="{{ route('pages.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <!-- Page Details -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Content</label>
                <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4">{{ old('content', $page->content) }}</textarea>
            </div>

            <div>
                <label for="meta_title" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="meta_description" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="meta_keywords" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Meta Keywords</label>
                <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">Page Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ old('status', $page->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $page->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Subpages Section -->
        <div id="subpages-container" class="space-y-6 mt-6">
            <h2 class="text-xl font-medium text-red-700 dark:text-slate-200 mt-6 mb-6">Subpages</h2> <hr>

            @foreach($page->subpages as $index => $subpage)
                <div class="subpage-entry">
                    <div class="flex flex-col space-y-4">
                        <div>
                            <label for="subpage_title_{{ $index }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Title</label>
                            <input type="text" name="subpages[{{ $index }}][title]" value="{{ old('subpages.' . $index . '.title', $subpage->title) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_slug_{{ $index }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Slug</label>
                            <input type="text" name="subpages[{{ $index }}][slug]" value="{{ old('subpages.' . $index . '.slug', $subpage->slug) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_description_{{ $index }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Description</label>
                            <textarea name="subpages[{{ $index }}][description]" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4">{{ old('subpages.' . $index . '.description', $subpage->description) }}</textarea>
                        </div>
                        <div>
                            <label for="subpage_thumbnail_{{ $index }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Thumbnail</label>
                            <input type="text" name="subpages[{{ $index }}][thumbnail]" value="{{ old('subpages.' . $index . '.thumbnail', $subpage->thumbnail) }}" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex flex-col space-y-4">
                        <div>
                        <button type="button" class="bg-red-600 text-white rounded-md px-2 py-1 mt-2" onclick="removeSubpage(this)">Remove</button>
                        </div>
                        <hr>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addSubpage()" class="bg-blue-600 text-white rounded-md px-2 py-1 mt-4">Add More Subpage</button>

        <div class="mt-6">
            <button type="submit" class="block bg-green-600 text-white rounded-md px-2 py-1 btn btn-sm">Update Page</button>
        </div>
    </form>

    <script>
        let subpageIndex = {{ count($page->subpages) }};

        function addSubpage() {
            const container = document.getElementById('subpages-container');
            const subpageHTML = `
                <div class="subpage-entry">
                    <div class="flex flex-col space-y-4">
                        <div>
                            <label for="subpage_title_${subpageIndex}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Title</label>
                            <input type="text" name="subpages[${subpageIndex}][title]" placeholder="Enter subpage title" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_slug_${subpageIndex}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Slug</label>
                            <input type="text" name="subpages[${subpageIndex}][slug]" placeholder="Enter subpage slug" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="subpage_description_${subpageIndex}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Description</label>
                            <textarea name="subpages[${subpageIndex}][description]" placeholder="Enter subpage description" class="mt-1 block w-full border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                        </div>
                        <div>
                            <label for="subpage_thumbnail_${subpageIndex}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Subpage Thumbnail</label>
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
@endsection
