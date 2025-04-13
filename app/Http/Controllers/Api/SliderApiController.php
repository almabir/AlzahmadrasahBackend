<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SliderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
class SliderApiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // $sliderItems = SliderItem::all();
            // return response()->json($sliderItems);
            $sliderItems = SliderItem::all()->map(function ($item) {
                $item->image_url = URL::asset(str_replace('storage', 'storage', $item->image_url));
                return $item;
            });
          
            return response()->json($sliderItems);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve slider items.', 'message' => $e->getMessage()], 500);
        }
    }
}