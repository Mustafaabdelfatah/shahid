<?php

namespace App\Http\Controllers\Api\Unit;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Unit\UnitRequest;
use App\Http\Resources\Unit\UnitListResource;
use App\Http\Resources\Unit\UnitResource;
use App\Models\AttachmentProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $units = Product::query()
                ->with([
                    'trans', 'category', 'country', 'state', 'city',
                    'gates', 'district', 'images', 'property','installments',
                    'viewproducts', 'wishlists', 'user' ,'admin'
                ])
                ->active(1)
                ->filter($request->query())
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            if ($units->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No units  found', []);
            }

        return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'units retrieved successfully', UnitListResource::collection($units)->response()->getData(true));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No units  found', []);
        }
    }

    public function show($id)
    {
        try {
            $unit = Product::query()
            ->with([
                    'trans', 'category', 'country', 'state',
                    'gates', 'city', 'district', 'images',
                  'property', 'viewproducts', 'wishlists', 'user', 'admin','installments'])
                  ->active(1)
                  ->findOrFail($id);
            // dd($unit);
            return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'unit retrieved successfully', new UnitResource($unit));
        } catch (\Exception $e) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND, 'No unit  found', []);
        }
    }

    public function store(UnitRequest $request)
    {

        try {
            DB::beginTransaction();
            // Step 1: Validations
            $data = $request->getSanitized();
            // Step 2: Save Data
            $unit = Product::create($data);

            // Step 3: Save Images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $attachmentProduct = AttachmentProduct::create([
                        'product_id' => $unit->id,
                        'image' => $image,
                    ]);
                }
            }
            // Step 4: Save Pivot Table in properties
            $unit->property()->attach($data['properties']);
            DB::commit();

            return ApiResponse::apiResponse(JsonResponse::HTTP_CREATED, 'created successfully', new UnitResource($unit));
        } catch (\Throwable $th) {
            DB::rollBack();

            return ApiResponse::apiResponse(JsonResponse::HTTP_NO_CONTENT,  $th->getMessage(), []);
        }
    }
}
