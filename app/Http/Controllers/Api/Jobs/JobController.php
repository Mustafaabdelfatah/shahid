<?php
namespace App\Http\Controllers\Api\Jobs;

use Exception;
use App\Models\Job;
use App\Models\JopRegister;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JopRequest;
use App\Http\Resources\Jobs\JobResource;

class JobController extends Controller
{
    public function index(Request $request)
    {
        try {
            // الحصول على عدد الوظائف لكل صفحة من الطلب، الافتراضي هو 10
            $perPage = $request->input('per_page', 10);

            // جلب الوظائف مع علاقتها category_job وتقسيم النتائج باستخدام paginate
            $jobs = Job::query()->with('categoryJob')->paginate($perPage);

            // التحقق مما إذا كانت النتيجة فارغة
            if ($jobs->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'لا توجد وظائف متاحة', []);
            }

            // إعادة النتائج مع رسالة النجاح
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'تم استرجاع الوظائف بنجاح', JobResource::collection($jobs)->response()->getData(true));
        } catch (Exception $e) {
            // تسجيل الخطأ بالتفصيل
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());  // إضافة تتبع الخطأ

            // في بيئة التطوير، يمكنك إظهار رسالة الخطأ الفعلية لمزيد من التفاصيل
            if (config('app.debug')) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), []);
            }

            // في بيئة الإنتاج، إرسال رسالة عامة
            return ApiResponse::apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'حدث خطأ أثناء استرجاع الوظائف', []);
        }
    }



    public function show($id)
    {
        try {
            $job = Job::query()->with('categoryJob')->findOrFail($id);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'Jobs retrieved successfully', new JobResource($job));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No Jobs found', []);
        }
    }

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
