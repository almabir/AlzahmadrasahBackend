<?php

namespace App\Http\Controllers;

use App\Models\DonationArea; // Corrected model name
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DonationAreaController extends Controller
{
    public function index()
    {
        try {
            $donationAreas = DonationArea::all();
            return view('donation-areas.index', compact('donationAreas'));
        } catch (QueryException $e) {
            Log::error('Database error in DonationArea index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while retrieving donation areas.');
        } catch (Exception $e) {
            Log::error('General error in DonationArea index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function create()
    {
        try {
            return view('donation-areas.create');
        } catch (Exception $e) {
            Log::error('General error in DonationArea create: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
            ], [
                'name.required' => 'The name field is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max' => 'The image may not be greater than 2MB in size.',
            ]);


            if ($request->hasFile('image')) {
                // put image in the public storage
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('donationarea'), $fileName);
                // $request['image'] = $fileName;
            }

            DonationArea::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => "donationarea/" .$fileName,
            ]);
            
            return redirect()->route('admin.donation-areas.index')->with('success', 'Donation area created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            Log::error('Database error in DonationArea store: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()->back()->with('error', 'An error occurred while creating the donation area.');
        } catch (Exception $e) {
            Log::error('General error in DonationArea store: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function edit(DonationArea $donationArea)
    {
        try {
            return view('donation-areas.edit', compact('donationArea'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.donation-areas.index')->with('error', 'Donation area not found.');
        } catch (Exception $e) {
            Log::error('General error in DonationArea edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function update(Request $request, DonationArea $donationArea)
    {
        try {
            // Validate the request with custom messages
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow image upload
            ], [
                'name.required' => 'The name field is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max' => 'The image may not be greater than 2MB in size.',
            ]);
       
            $validated = $request->all();
        
                if ($request->hasFile('image')) {
                    // put image in the public storage
                    $fileName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('donationarea'), $fileName);
                    $validated['image'] = 'donationarea/' . $fileName;
               }
        $donationArea->update($validated);
        
    
            return redirect()->route('admin.donation-areas.index')->with('success', 'Donation area updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            Log::error('Database error in DonationArea update: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()->back()->with('error', 'An error occurred while updating the donation area.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.donation-areas.index')->with('error', 'Donation area not found.');
        } catch (Exception $e) {
            Log::error('General error in DonationArea update: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function destroy(DonationArea $donationArea)
    {
        try {
            if (file_exists(public_path() . '/donationarea/'. $donationArea->image)) {
                unlink(public_path() . '/donationarea/'. $donationArea->image);
            }    
            $donationArea->delete();
            return redirect()->route('admin.donation-areas.index')->with('success', 'Donation area deleted successfully.');
        } catch (QueryException $e) {
            Log::error('Database error in DonationArea destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the donation area.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.donation-areas.index')->with('error', 'Donation area not found.');
        } catch (Exception $e) {
            Log::error('General error in DonationArea destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

}