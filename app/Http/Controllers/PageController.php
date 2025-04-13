<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SubPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    // Display a list of all pages
    public function index()
    {
        try {
            $pages = Page::all();
            return view('pages.index', compact('pages'));
        } catch (\Exception $e) {
            Log::error('Error fetching pages: ' . $e->getMessage());
            return redirect()->route('pages.index')->with('error', 'Failed to load pages.');
        }
    }

    // Show the form to create a new page
    public function create()
    {
        return view('pages.create');
    }

    // Store a newly created page and its subpages
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|unique:pages,slug',
                'content' => 'nullable|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'status' => 'nullable|boolean',
                'subpages' => 'nullable|array',  // Ensure subpages is an array if present
                'subpages.*.title' => 'required|string|max:255',
                'subpages.*.slug' => 'required|unique:sub_pages,slug',
                'subpages.*.description' => 'nullable|string',
                'subpages.*.thumbnail' => 'nullable|string',
                'subpages.*.status' => 'nullable|boolean',
            ]);

            // Create the main page
            $page = Page::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => $request->status ?? 1,
            ]);

            // Create subpages if any
            if ($request->has('subpages')) {
                foreach ($request->subpages as $subpageData) {
                    SubPage::create([
                        'page_id' => $page->id,
                        'title' => $subpageData['title'],
                        'slug' => $subpageData['slug'],
                        'description' => $subpageData['description'],
                        'thumbnail' => $subpageData['thumbnail'],
                        'status' => $subpageData['status'] ?? 1,
                    ]);
                }
            }

            return redirect()->route('pages.index')->with('success', 'Page created successfully!');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log and display a generic error message for unexpected exceptions
            Log::error('Error storing page: ' . $e->getMessage());
            return redirect()->route('pages.index')->with('error', 'Failed to create page.');
        }
    }

    // Show the form to edit the specified page
    public function edit($pageId)
    {
        $page = Page::find($pageId);
        return view('pages.edit', compact('page'));
    }

    // Update the specified page and its subpages
    public function update(Request $request, $page)
    {
        try {
            $page = Page::find($page);
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|unique:pages,slug,' . $page->id,
                'content' => 'nullable|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'status' => 'nullable|boolean',
                'subpages' => 'nullable|array',
                'subpages.*.title' => 'required|string|max:255',
                'subpages.*.slug' => 'required|unique:sub_pages,slug,' . $page->id,
                'subpages.*.description' => 'nullable|string',
                'subpages.*.thumbnail' => 'nullable|string',
                'subpages.*.status' => 'nullable|boolean',
            ]);

            // Update the main page
            $page->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => $request->status ?? 1,
            ]);

            // Update or create subpages if any
            if ($request->has('subpages')) {
                foreach ($request->subpages as $subpageData) {
                    SubPage::updateOrCreate(
                        ['slug' => $subpageData['slug'], 'page_id' => $page->id],
                        [
                            'title' => $subpageData['title'],
                            'description' => $subpageData['description'],
                            'thumbnail' => $subpageData['thumbnail'],
                            'status' => $subpageData['status'] ?? 1,
                        ]
                    );
                }
            }

            return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log and display a generic error message for unexpected exceptions
            Log::error('Error updating page: ' . $e->getMessage());
            return redirect()->route('pages.index')->with('error', 'Failed to update page.');
        }
    }

    // Show the specified page
    public function show(Page $page)
    {
        try {
            return view('pages.show', compact('page'));
        } catch (\Exception $e) {
            Log::error('Error showing page: ' . $e->getMessage());
            return redirect()->route('pages.index')->with('error', 'Failed to load page.');
        }
    }

    // Delete the specified page and its subpages
    public function destroy($page)
    {
        try {
            $page = Page::find($page);
            // Delete subpages first
            $page->subPages()->delete();

            // Delete the page
            $page->delete();

            return redirect()->route('pages.index')->with('success', 'Page deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting page: ' . $e->getMessage());
            return redirect()->route('pages.index')->with('error', 'Failed to delete page.');
        }
    }
}
