<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingController extends Controller
{
    // Display the settings form
    public function edit()
    {
        $settings = Setting::firstOrCreate(['key' => 'settings']);
        return view('settings.edit', compact('settings'));
    }

    // Update the settings
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'feature_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'feature_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'feature_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find or create the settings record
        $settings = Setting::firstOrCreate(['key' => 'settings']);

        // Handle file uploads
        $this->handleFileUpload($request, $settings, 'logo');
        $this->handleFileUpload($request, $settings, 'feature_image_1');
        $this->handleFileUpload($request, $settings, 'feature_image_2');
        $this->handleFileUpload($request, $settings, 'feature_image_3');

        // Update the settings
        $settings->update([
            'company_name' => $request->company_name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'website' => $request->website,
        ]);

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    }

    // Helper function to handle file uploads
    private function handleFileUpload(Request $request, Setting $settings, string $field): void
    {
        if ($request->hasFile($field)) {
            // Delete the old file if it exists
            // Delete the associated image file if it exists
            if (file_exists(public_path() . 'settings'. $settings->$field)) {
                unlink(public_path() . 'settings'. $settings->$field);
            }  
            // Store the new file
            $fileName = time() . '_' . $field . '.' . $request->$field->extension();
            // put image in the public storage
            $request->$field->move(public_path('settings'), $fileName);
            // $request['image'] = $fileName;
            $settings->$field = 'settings/' . $fileName;
            $settings->save();
        }
    }
}