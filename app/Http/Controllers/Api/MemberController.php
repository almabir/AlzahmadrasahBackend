<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_type' => 'required|string',
            'name' => 'required|string',
            'fathers_name' => 'nullable|string',
            'probashi' => 'required|boolean',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'occupation' => 'nullable|string',
            'reference' => 'nullable|string',
            'address' => 'required|string',
            'donation_payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
        ]);

        $member = Member::create($validatedData);

        return response()->json(['message' => 'Application submitted successfully.', 'member' => $member], 201);
    }

    public function initiatePayment(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'member_type' => 'required|string',
            'name' => 'required|string',
            'fathers_name' => 'nullable|string',
            'probashi' => 'required|boolean',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'occupation' => 'nullable|string',
            'reference' => 'nullable|string',
            'address' => 'required|string',
            'donation_payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
        ]);

        // Interact with your payment gateway API
        // Example (replace with your actual payment gateway logic):
        $paymentGatewayResponse = Http::post('YOUR_PAYMENT_GATEWAY_API', $validatedData);

        if ($paymentGatewayResponse->successful()) {
            $paymentData = $paymentGatewayResponse->json();
            return response()->json([
                'redirectUrl' => $paymentData['redirect_url'], // Adjust based on your payment gateway response
            ]);
        } else {
            return response()->json(['message' => 'Payment initiation failed.'], 500);
        }
    }
}
