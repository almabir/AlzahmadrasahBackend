<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GalleryCategoryController extends Controller
{
    public function indexView(): View
    {
        $categories = GalleryCategory::all();
        return view('gallery-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('gallery-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:gallery_categories',
        ]);

        GalleryCategory::create($request->all());

        return redirect()->route('gallery-categories.index');
    }

    public function edit(GalleryCategory $galleryCategory): View
    {
        return view('gallery-categories.edit', compact('category'));
    }

    public function update(Request $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        $request->validate([
            'name' => 'string|unique:gallery_categories,name,' . $galleryCategory->id,
        ]);

        $galleryCategory->update($request->all());

        return redirect()->route('gallery-categories.index');
    }

    public function destroy(GalleryCategory $galleryCategory): RedirectResponse
    {
        $galleryCategory->delete();

        return redirect()->route('gallery-categories.index');
    }
}