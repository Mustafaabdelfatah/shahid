<?php

namespace App\Http\Controllers\Api\News;

use App\Helpers\ApiResponse;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\News\CategoryNewResource;

class CategroyNewsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $categroy_news = CategoryNews::query()->with(['trans','news'])->active(1)->paginate($perPage);
            if ($categroy_news->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No Categories News  found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Categories News retrieved successfully',   CategoryNewResource::collection($categroy_news)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No Categories News found',[]);
        }
    }
    public function show($id)
    {
        try {
            $categroy_news = CategoryNews::query()->with(['trans','news'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'categroy news retrieved successfully',   new CategoryNewResource($categroy_news));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No categroy News  found',[]);
        }
    }
}
