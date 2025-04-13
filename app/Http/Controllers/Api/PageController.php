<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    // Fetch all pages with their subpages
    public function index()
    {
        return response()->json(Page::with('subPages')->get(), 200);
    }

    // Fetch a single page by ID with its subpages
    public function show($id)
    {
        $page = Page::with('subPages')->whereSlug($id)->first();
        
        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        return response()->json($page, 200);
    }

    // // Create a new page with optional subpages
    // public function store(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'slug' => 'required|string|unique:pages,slug',
    //             'content' => 'nullable|string',
    //             'meta_title' => 'nullable|string|max:255',
    //             'meta_description' => 'nullable|string',
    //             'meta_keywords' => 'nullable|string',
    //             'status' => 'boolean',
    //             'subpages' => 'array',
    //             'subpages.*.title' => 'required|string|max:255',
    //             'subpages.*.description' => 'nullable|string',
    //             'subpages.*.thumbnail' => 'nullable|string',
    //             'subpages.*.slug' => 'required|string|unique:sub_pages,slug',
    //             'subpages.*.status' => 'boolean'
    //         ]);

    //         $page = Page::create($validated);

    //         if (!empty($validated['subpages'])) {
    //             $page->subPages()->createMany($validated['subpages']);
    //         }

    //         return response()->json($page->load('subPages'), 201);
    //     } catch (ValidationException $e) {
    //         return response()->json(['errors' => $e->errors()], 422);
    //     }
    // }

    // // Update an existing page and its subpages
    // public function update(Request $request, $id)
    // {
    //     $page = Page::find($id);

    //     if (!$page) {
    //         return response()->json(['message' => 'Page not found'], 404);
    //     }

    //     try {
    //         $validated = $request->validate([
    //             'title' => 'sometimes|string|max:255',
    //             'slug' => 'sometimes|string|unique:pages,slug,' . $id,
    //             'content' => 'nullable|string',
    //             'meta_title' => 'nullable|string|max:255',
    //             'meta_description' => 'nullable|string',
    //             'meta_keywords' => 'nullable|string',
    //             'status' => 'boolean',
    //             'subpages' => 'array',
    //             'subpages.*.id' => 'sometimes|exists:sub_pages,id',
    //             'subpages.*.title' => 'required|string|max:255',
    //             'subpages.*.description' => 'nullable|string',
    //             'subpages.*.thumbnail' => 'nullable|string',
    //             'subpages.*.slug' => 'required|string',
    //             'subpages.*.status' => 'boolean'
    //         ]);

    //         $page->update($validated);

    //         if (!empty($validated['subpages'])) {
    //             foreach ($validated['subpages'] as $subPageData) {
    //                 if (isset($subPageData['id'])) {
    //                     $page->subPages()->where('id', $subPageData['id'])->update($subPageData);
    //                 } else {
    //                     $page->subPages()->create($subPageData);
    //                 }
    //             }
    //         }

    //         return response()->json($page->load('subPages'), 200);
    //     } catch (ValidationException $e) {
    //         return response()->json(['errors' => $e->errors()], 422);
    //     }
    // }

    // // Delete a page and its subpages
    // public function destroy($id)
    // {
    //     $page = Page::find($id);

    //     if (!$page) {
    //         return response()->json(['message' => 'Page not found'], 404);
    //     }

    //     $page->delete();

    //     return response()->json(['message' => 'Page deleted successfully'], 200);
    // }
}
