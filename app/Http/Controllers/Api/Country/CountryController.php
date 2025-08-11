<?php

namespace App\Http\Controllers\Api\Country;

use App\Models\Country;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $countries = Country::query()->with('trans')->active(1)->paginate($perPage);
            if ($countries->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No countries found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  ' countries successfully',   CountryResource::collection($countries)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'Failed to retrieve countries', []);
        }
    }
    // return CountryResource::collection($countries);


    public function show($id)
    {
        try {
            $country = Country::query()->with('trans')->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'country successfully',  new CountryResource($country));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'Failed to retrieve country', []);
        }
    }
}
