<?php

namespace App\Http\Controllers\Api\ServiceProvided;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ServiceProvided;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceProvidedController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:5000',
            'service' => 'required|in:Property Sale,Property Rental,Property Management,Property Valuation,Mortgage Services,Home Inspection,Property Marketing,Lease Negotiation',
        ]);
        if ($validator->fails()) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,'validation failed',$validator->messages()->all());
        }
        $serviceProvided = ServiceProvided::create($request->all());
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,'Service provided created successfully',$serviceProvided);

    }


}
