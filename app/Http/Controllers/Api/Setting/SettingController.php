<?php

namespace App\Http\Controllers\Api\Setting;

use App\Models\Setting;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $setting = Setting::query()->with('trans')->where('type','websit')->first();
            
            if (!$setting) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No setting found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK ,  'Setting retrieved successfully', new SettingResource($setting));
          
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve setting', 'error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
