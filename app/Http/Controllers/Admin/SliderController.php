<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class SliderController extends Controller
{
    public function index()
    {
        try {
            $sliderItems = SliderItem::all();
            return view('sliders.index', compact('sliderItems'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve slider items: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'link' => 'nullable|url|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                // put image in the public storage
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('sliders'), $fileName);
                // $request['image'] = $fileName;
            }

            SliderItem::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'link' => $request->link,
                'image_url' => "sliders/" .$fileName,
            ]);

            return redirect()->route('admin.slider.index')->with('success', 'Slider item created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create slider item: ' . $e->getMessage());
        }
    }

    public function edit(SliderItem $sliderItem)
    {
        try {
            return view('sliders.edit', compact('sliderItem'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.slider.index')->with('error', 'Slider item not found.');
        } catch (Exception $e) {
            return redirect()->route('admin.slider.index')->with('error', 'Failed to load slider item for editing: ' . $e->getMessage());
        }
    }

    public function update(Request $request, SliderItem $sliderItem)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'link' => 'nullable|url|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $sliderItem->title = $request->title;
            $sliderItem->sub_title = $request->sub_title;
            $sliderItem->link = $request->link;

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($sliderItem->image_url) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $sliderItem->image_url));
                }

                $imagePath = $request->file('image')->store('slider_images', 'public');
                $sliderItem->image_url = Storage::url($imagePath);
            }

            $sliderItem->save();

            return redirect()->route('admin.slider.index')->with('success', 'Slider item updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update slider item: ' . $e->getMessage());
        }
    }

    public function destroy(SliderItem $sliderItem)
    {
        try {
            // Delete the associated image file if it exists
            if (file_exists(public_path() . '/sliders/'. $sliderItem->image_url)) {
                unlink(public_path() . '/sliders/'. $sliderItem->image_url);
            }    
            $sliderItem->delete();

            return redirect()->route('admin.slider.index')->with('success', 'Slider item deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.slider.index')->with('error', 'Slider item not found.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete slider item: ' . $e->getMessage());
        }
    }
}