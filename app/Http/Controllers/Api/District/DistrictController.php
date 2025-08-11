<?php

namespace App\Http\Controllers\Api\District;

use App\Models\District;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
       
        try {
            // $perPage = $request->input('per_page', 10); // Default per page is 10
            $districts = District::query()
            ->with(['trans','country', 'state','city'])
            ->active(1)
            ->get();
            if ($districts->isEmpty()) {
                // No cities found, return appropriate response
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No districts found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'districts successfully',   DistrictResource::collection($districts)->response()->getData(true));
        } catch (\Exception $e) {
           return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No districts found',[]);
        }
    }

    public function show($id)
    {
        try {
            $district = District::query()->with(['trans','country', 'state','city'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'district successfully',   new DistrictResource($district));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No district found',[]);
        }
    }
}
