<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Get settings
    public function index()
    {
        $settings = Setting::firstOrCreate(['key' => 'settings']);
        return response()->json([
            'success' => true,
            'data' => $settings,
        ]);
    }
}