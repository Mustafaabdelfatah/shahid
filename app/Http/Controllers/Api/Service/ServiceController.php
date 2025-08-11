<?php

namespace App\Http\Controllers\Api\Service;

use Exception;
use App\Models\Service;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceResource;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $services = Service::query()
                ->with(['trans', 'category_service', 'images', 'features'])
                ->active(1)
                ->orderedBySort('desc') // Use the scope to order by sort
                ->paginate($perPage);

            if ($services->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No services found', []);
            }

            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'Services retrieved successfully', ServiceResource::collection($services)->response()->getData(true));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No services found', []);
        }
    }



    public function show($id)
    {
        try {
            $services = Service::query()->with(['trans', 'category_service', 'images','features'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'services retrieved successfully', new  ServiceResource($services));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No services found', []);
        }
    }
}
