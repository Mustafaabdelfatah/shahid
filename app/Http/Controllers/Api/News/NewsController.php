<?php

namespace App\Http\Controllers\Api\News;

use App\Models\News;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsController extends Controller
{
    public function index(Request $request)
    {
       
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $news = News::query()->with(['trans','categories','tags' ,'images'])->active(1)->paginate($perPage);
          
            if ($news->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No  News found',[]);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'News successfully',   NewResource::collection($news)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No  News found',[]);
        }
    }

    public function show($id)
    {
        try {
            $news = News::query()->with(['trans','categories','tags','images'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'News successfully',   new NewResource($news));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND ,  'No  News found',[]);
        }
    }

}
