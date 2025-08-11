<?php

namespace App\Http\Controllers\Api\News;

use App\Models\TagNews;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\News\TagNewResource;

class TagNewsController extends Controller
{
    public function index(Request $request)
    {
       
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $tag_news = TagNews::query()->with(['trans','news'])->active(1)->paginate($perPage);
            if ($tag_news->isEmpty()) {
                // No cities found, return appropriate response
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No Tag  News found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Tags successfully',   TagNewResource::collection($tag_news)->response()->getData(true));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve Tag New', 'error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $tag_news = TagNews::query()->with(['trans','news'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Tags successfully', new TagNewResource($tag_news));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No Tag  News found',[]);
        }
    }
}
