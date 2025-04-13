<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Validation\ValidationException;

class VolunteerController extends Controller
{
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'probashi' => 'required|in:yes,no',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:volunteers,email',
            'nid_number' => 'nullable|string|max:50',
            'emergency_phone' => 'nullable|string|max:20',
            'facebook_id' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'volunteer_for' => 'nullable|string|max:255',
            'special_skill' => 'nullable|string|max:255',
            'permanent_district' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string',
            'present_district' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
        ]);

        // Store volunteer data
        try {
            $volunteer = Volunteer::create($validatedData);
            return response()->json(['message' => 'Registration successful!', 'volunteer' => $volunteer], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
