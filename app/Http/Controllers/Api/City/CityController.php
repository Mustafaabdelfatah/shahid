<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $cities = City::query()->with(['trans', 'country', 'state'])->active(1)->paginate($perPage);
            if ($cities->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No cities found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'cities retrieved successfully', CityResource::collection($cities)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No cities found', []);
        }
    }


    public function show($id)
    {
        try {
            $cities = City::query()->with(['trans', 'country', 'state'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'city retrieved successfully', new  CityResource($cities));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No city found', []);
        }
    }
}
