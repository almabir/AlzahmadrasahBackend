<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationArea;
use Illuminate\Http\JsonResponse;

class DonationAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $donationAreas = DonationArea::all();

        return response()->json($donationAreas);
    }
    public function singIndex($id)
    {
        // Find the donation area by ID
        $donationArea = DonationArea::find($id);

        // If the donation area doesn't exist, return a 404 error
        if (!$donationArea) {
            return response()->json([
                'success' => false,
                'message' => 'Donation area not found.',
            ], 404);
        }

        // Return the donation area as a JSON response
        return response()->json([
            'success' => true,
            'data' => $donationArea,
        ]);
    }
}