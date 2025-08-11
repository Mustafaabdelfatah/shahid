<?php

namespace App\Http\Controllers\Api\Gate;

use App\Models\Gates;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Gate\GateResource;

class GatesController extends Controller
{
    public function index(Request $request)
    {
       
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $gates = Gates::query()->with(['trans','units'])->active(1)->paginate($perPage);
            // return response()->json($gates);
            if ($gates->isEmpty()) {
                // No gates found, return appropriate response
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No gates ',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'gates successfully',   GateResource::collection($gates)->response()->getData(true));
        } catch (\Exception $e) {
           return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No gates found',[]);
        }
    }

        public function show($id)
    {
        try {
            $gates = Gates::query()->with(['trans','units'])->active(1)->findOrFail($id);

            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'gates news retrieved successfully',   new GateResource($gates));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No gates   found',[]);
        }
    }
}