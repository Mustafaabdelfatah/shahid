<?php

namespace App\Http\Controllers\Api\CategoryService;

use Exception;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryService\CategoryServiceResource;

class CategoryServiceController extends Controller
{
    public function index(Request $request)
    {
      
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $categoryService = CategoryService::query()->with(['trans','services.images'])->paginate($perPage);
     
            if ($categoryService->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No category Service found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'categoryService retrieved successfully', CategoryServiceResource::collection($categoryService)->response()->getData(true));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No categoryService found', []);
        }
    }


    public function show($id)
    {
        try {
            $categoryService = CategoryService::query()->with(['trans','services.images'])->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'categoryService retrieved successfully', new  CategoryServiceResource($categoryService));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No categoryService found', []);
        }
    }
}