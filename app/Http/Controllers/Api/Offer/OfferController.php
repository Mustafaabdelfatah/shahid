<?php
namespace App\Http\Controllers\Api\Offer;


use Exception;
use App\Models\Offers;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Offer\OfferResource;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $Offers = Offers::query()->with(['trans'])->active(1)->paginate($perPage);
            // dd($Offers);
            // return response()->json($Offers);
            if ($Offers->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No Offers found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Offers retrieved successfully',   OfferResource::collection($Offers)->response()->getData(true));
        } catch (Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No Offers found', []);
        }
    }


    public function show($id)
    {
        try {
            $Offers = Offers::query()->with(['trans'])->active(1)->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Offers retrieved successfully', new  OfferResource($Offers));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No Offers found', []);
        }
    }
}