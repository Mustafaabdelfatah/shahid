<?php

namespace App\Http\Controllers\Api\Agency;

use App\Models\Team;
use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgancyResource;

class AgencyController extends Controller
{

    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $agencies = User::query()->active(1)->where('role', 'agency')->with(['projects.units'])->paginate($perPage);
            if ($agencies->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No agency found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK ,  'agencies retrieved successfully',  AgancyResource::collection($agencies)->response()->getData(true));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve agency', 'error' => $e->getMessage(),'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            $agencies = User::query()->active(1)->where('role', 'agency')->with(['projects.units'])->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK ,  'agenc retrieved successfully',  new AgancyResource($agencies));
        } catch (\Exception $e) {
      
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  $e->getMessage(),[]);
        }
    }
}   
