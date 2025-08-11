<?php

namespace App\Http\Controllers\Api\Category;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            // $perPage = $request->input('per_page', 10); // Default per page is 10
            $categories = Category::query()->with(['trans', 'units'])->active(1)->get();
            if ($categories->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No categories found', []);
            }

            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'categories retrieved successfully', CategoryResource::collection($categories)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No categories found', []);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::query()->with(['trans'])->active(1)->findOrFail($id);

            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'category retrieved successfully', new CategoryResource($category));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'Failed to retrieve category', []);
        }
    }
}
