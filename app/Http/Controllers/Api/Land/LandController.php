<?php
namespace App\Http\Controllers\Api\Land;

use Exception;
use App\Models\Land;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Land\LandResource;

class LandController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $land = Land::query()->with(['trans'])->active(1)->paginate($perPage);
            // dd($land);
            // return response()->json($land);
            if ($land->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No lands found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'lands retrieved successfully',   LandResource::collection($land)->response()->getData(true));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No lands found', []);
        }
    }


    public function show($id)
    {
        try {
            $land = Land::query()->with(['trans'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'lands retrieved successfully', new  LandResource($land));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No lands found', []);
        }
    }
}