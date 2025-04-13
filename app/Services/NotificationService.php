<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendEmailOtp($email, $otp)
    {
        try {
            Mail::to($email)->send(new OtpMail($otp));
            return response()->json(['message' => 'OTP sent successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP', 'details' => $e->getMessage()], 500);
        }
    }

    public function sendSmsOtp($identifier, $otp)
    {
        // Implement SMS sending using Twilio or another service
        // Example: Twilio::message($phoneNumber, "Your OTP is: $otp");
        $apiUrl = "https://smsplus.sslwireless.com/api/v3/send-sms";  // Replace with the correct SSLCare API URL
        $apiKey = "f45ledxj-u00muwbu-6yjl9eab-opnd2nl2-kfhd1mku";  // Replace with your SSLCare API Key
        $sender = "01917873701";  // Replace with the sender number or name
        $message = "Your OTP is: $otp";
    
        try{
            $response = Http::asForm()->post($apiUrl, [
                'user' => 'mahmudazaman45@gmail.com',  // SSLCare API username
                'password' => 'cBySycF',  // SSLCare API password
                'to' => $identifier,  // The recipient's phone number
                'message' => $message,  // The message content
                'sender' => $sender,  // Sender number or name
                'api_key' => $apiKey  // Your SSLCare API key
            ]);

            // Check the response from SSLCare API
            if ($response->successful()) {
                return true;  // SMS sent successfully
            } else {
                // Log or handle the error
                Log::error("Failed to send SMS OTP", ['response' => $response->body()]);
                return false;  // SMS sending failed
            }
        }catch (\Exception $e) {
            // Log any exceptions
            Log::error("Exception while sending SMS OTP", ['error' => $e->getMessage()]);
            return false;
        }
    }
}