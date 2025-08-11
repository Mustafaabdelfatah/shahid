<?php

namespace App\Http\Controllers\Api\State;

use App\Models\State;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class StateController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $states = State::query()->with(['trans','country'])->active(1)->paginate($perPage);
            if ($states->isEmpty()) {
                // No states found, return appropriate response
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No states  found',[]);
            }
          
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'states retrieved successfully',   StateResource::collection($states)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No states  found',[]);
        }
    }


    public function show($id)
    {
        try {
            $states = State::query()->with(['trans','country'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'state retrieved successfully',   new StateResource($states));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No states  found',[]);
        }
    }
}
