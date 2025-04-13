<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Services\OtpService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    protected $otpService;
    protected $notificationService;

    public function __construct(OtpService $otpService, NotificationService $notificationService)
    {
        $this->otpService = $otpService;
        $this->notificationService = $notificationService;
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string', // Email or phone
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $identifier = $request->input('identifier');

        $donation = Donation::where('donor_email', $identifier)->orWhere('donor_mobile', $identifier)->first();

        if (!$donation) {
            return response()->json(['message' => 'Identifier not found'], 404);
        }

        $otp = $this->otpService->generateAndStoreOtp($identifier);

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $this->notificationService->sendEmailOtp($identifier, $otp);
        } else {
            $this->notificationService->sendSmsOtp($identifier, $otp);
        }

        return response()->json(['message' => 'OTP sent successfully']);
    }



    public function verifyOtp(Request $request)
    {
        try {
            // \Log::info('OTP verification started', $request->all());

            $validator = Validator::make($request->all(), [
                'identifier' => 'required|string',
                'otp' => 'required|string',
            ]);
            // \Log::info('Received data:', $request->all());
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $identifier = $request->input('identifier');
            $otp = $request->input('otp');

            // \Log::info("Checking OTP for identifier: $identifier with OTP: $otp");

            $otpRecord = $this->otpService->verifyOtp($identifier, $otp);

            if (!$otpRecord) {
                Log::info("OTP verification failed for identifier: $identifier with OTP: $otp");
                return response()->json(['message' => 'Invalid OTP'], 401);
            }

            $donor = Donation::where('donor_email', $identifier)
                    ->orWhere('donor_mobile', $identifier)
                    ->first();

            if (!$donor) {
                // \Log::error("Donor not found for identifier: $identifier");
                return response()->json(['error' => 'Donor not found'], 404);
            }

            // Generate token manually
            // \Log::info("Generating JWT token for donor: " . $donor->id);
            $token = JWTAuth::fromUser($donor);
            // Log::info('Generated JWT Token: ' . $token);
            if (!$token) {
                // \Log::error("JWT token generation failed");
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $this->otpService->deleteOtp($otpRecord);

            return response()->json([
                'token' => $token, 
                'user' =>  $donor,
            ]);
        } catch (\Exception $e) {
            // \Log::error('OTP Verification Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // public function sendEmailOtp($email, $otp)
    // {
    //     try {
    //         Mail::to($email)->send(new OtpMail($otp));
    //         return response()->json(['message' => 'OTP sent successfully'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to send OTP', 'details' => $e->getMessage()], 500);
    //     }
    // }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logged out successfully']);
    }
}