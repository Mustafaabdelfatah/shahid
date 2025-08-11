<?php

namespace App\Http\Controllers\Api\Jobs;

use Throwable;
use App\Models\JopRegister;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Jop_Registers;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JopRequest;

class JobRegisterController extends Controller
{
    public function store(JopRequest $request)
    {
        try {
            $existingJop = JopRegister::where('email', $request->email)->first();

            if ($existingJop) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_CONFLICT, 'لقد تم التقديم مسبقًا باستخدام هذا البريد الإلكتروني', []);
            }

            $data = $request->getSanitized();

            $jop = JopRegister::create($data);

            return ApiResponse::apiResponse(JsonResponse::HTTP_CREATED, 'تم إنشاء السجل بنجاح', $jop);

        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'حدث خطأ أثناء التقديم', []);
        }
    }
}
