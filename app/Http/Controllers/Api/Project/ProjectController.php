<?php

namespace App\Http\Controllers\Api\Project;

use Exception;
use App\Models\Project;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Project\ProjectResource;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $project = Project::query()
                ->with(['trans', 'attachments', 'type_units', 'units.category', 'units.installments', 'user.projects'])
                ->active(1)
                ->filter($request->query())
                ->paginate($perPage);
            if ($project->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No  project found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'project successfully', ProjectResource::collection($project)->response()->getData(true));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No  project found', []);
        }
    }


    public function show($id)
    {
        try {
            $project = Project::query()
                ->with([
                    'trans',
                    'units',
                    'attachments',
                    'type_units',
                    'installments',
                    'property',
                    'malls',
                    'units.category',
                    'units.installments',
                    'user'
                ])
                ->active(1)
                ->findOrFail($id);

            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'project successfully', new ProjectResource($project));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No  project found', []);
        }
    }
}
