<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Models\Deposit;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Deposit\DepositResource;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $deposits = Deposit::query()->with('unitInstallments')->paginate($perPage);
            if ($deposits->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No deposits found', []);
            }
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'deposits successfully',   DepositResource::collection($deposits)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'Failed to retrieve deposits', []);
        }
    }
    // return CountryResource::collection($countries);


    public function show($id)
    {
        try {
            $deposits = Deposit::query()->with('unitInstallments')->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'deposits successfully',  new DepositResource($deposits));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'Failed to retrieve deposits', []);
        }
    }
}
