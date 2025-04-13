<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{


    public function index(Request $request)
    {
        $identifier = $request->input('sub'); // Get user ID from request body
    
        if (!$identifier) {
            return response()->json(['message' => 'User ID (sub) is required'], 400);
        }
    
        // Fetch donor info using donor_email or donor_mobile
        $donor = Donation::find($identifier);
    
        if (!$donor) {
            return response()->json(['message' => 'Donor not found'], 404);
        }
    
        return response()->json([
            'name' => $donor->donor_name,
            'email' => $donor->donor_email,
            'address' => $donor->address,
            'mobile' => $donor->donor_mobile,
            'last_donation' => $donor->amount,
            'total_donations' => Donation::where('donor_email', $donor->donor_email)
                                        ->orWhere('donor_mobile', $donor->donor_mobile)
                                        ->count(),
            'min_donation' => Donation::where('donor_email', $donor->donor_email)
                                    ->orWhere('donor_mobile', $donor->donor_mobile)
                                    ->min('amount'),
            'max_donation' => Donation::where('donor_email', $donor->donor_email)
                                    ->orWhere('donor_mobile', $donor->donor_mobile)
                                    ->max('amount'),
            'total_amount' => Donation::where('donor_email', $donor->donor_email)
                                    ->orWhere('donor_mobile', $donor->donor_mobile)
                                    ->sum('amount'),
        ]);
    }

    public function updateAddress(Request $request)
    {
        $request->validate(['address' => 'required|string']);

        $identifier = $request->input('sub'); 
        $user =  Donation::find($identifier);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's address
        $user->address = $request->input('address');
        $user->save();

        return response()->json(['message' => 'Address updated successfully']);
    }
}