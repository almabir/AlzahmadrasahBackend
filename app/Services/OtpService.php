<?php

namespace App\Services;

use App\Models\Otp;
use Carbon\Carbon;

class OtpService
{
    public function generateAndStoreOtp($identifier)
    {
        $otp = random_int(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        Otp::updateOrCreate(
            ['identifier' => $identifier],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        return $otp;
    }

    public function verifyOtp($identifier, $otp)
    {
        return Otp::where('identifier', $identifier)
            ->where('otp', $otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }

    public function deleteOtp($otpRecord)
    {
        $otpRecord->delete();
    }
}