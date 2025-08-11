<?php

namespace App\Http\Controllers\Api\Property;

use App\Models\property;
use App\Helpers\ApiResponse;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class PropertyController extends Controller
{
    public function index(Request $request)
    {

        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $properties = PropertyType::query()->with(['trans'])->active(1)->paginate($perPage);
            if ($properties->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No properties  found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'properties retrieved successfully',   PropertyResource::collection($properties)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No properties  found',[]);
        }
    }

    public function show($id)
    {
        try {
            $property = PropertyType::query()->with(['trans'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'property retrieved successfully',  new PropertyResource($property));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No property  found',[]);
        }
    }
}
