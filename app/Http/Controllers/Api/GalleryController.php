<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GalleryController extends Controller
{
    public function index(): JsonResponse
    {
        $galleries = Gallery::with('categoryName')->get()->groupBy('categoryName.name');
        $images = [];

        foreach ($galleries as $category => $items) {
            $images[$category] = $items->map(function ($item) {
                return [
                    'image_url' => $item->image_url,
                    'title' => $item->title,
                    'gallery_category_id' => $item->gallery_category_id,
                ];
            })->toArray();
        }

        return response()->json($images);
    }


    // Web Views Functions
    public function indexView(): View
    {
        $galleries = Gallery::with('categoryName')->get();
        return view('galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        $categories = GalleryCategory::all();
        return view('galleries.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
            'title' => 'string|nullable',
        ]);

        $fileName = null;

        if ($request->hasFile('image')) {
            // Put image in the public storage
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('galleries'), $fileName);
        }

        Gallery::create([
            'category' => $request->gallery_category_id,
            'image_url' => $fileName ? "galleries/" . $fileName : null, // Store the URL
            'title' => $request->title,
        ]);

        return redirect()->route('galleries.index');
    }

    public function edit(Gallery $gallery): View
    {
        $categories = GalleryCategory::all();
        return view('galleries.edit', compact('gallery', 'categories'));
    }
    public function destroy(Gallery $gallery): RedirectResponse
    {
        try {
            // Delete the associated image file if it exists
            if (file_exists(public_path() . '/galleries/'. $gallery->image_url)) {
                unlink(public_path() . '/galleries/'. $gallery->image_url);
            }  
    
            // Delete the gallery record
            $gallery->delete();
    
            return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully.');
        } catch (\Exception $e) {
            // Log the error and return with an error message
            Log::error('Error deleting gallery: ' . $e->getMessage());
            return redirect()->route('galleries.index')->with('error', 'An error occurred while deleting the gallery.');
        }
    }
    public function updateWeb(Request $request, Gallery $gallery): RedirectResponse
    {
        $request->validate([
            'gallery_category_id' => 'exists:gallery_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional
            'title' => 'string|nullable',
        ]);

        $data = $request->except('image'); // Exclude image from initial update

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($gallery->image_url) {
                $oldImagePath = public_path($gallery->image_url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload the new image
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('galleries'), $fileName);
            $data['image_url'] = "galleries/" . $fileName;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index');
    }

    public function destroyWeb(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('galleries.index');
    }
}