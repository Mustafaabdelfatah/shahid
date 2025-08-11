<?php
namespace App\Http\Controllers\Api\Unit\Package;




use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\DatePackageProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\Unit\UnitResource;
use App\Http\Resources\Product\ProductResource;

class PackageUnitController extends Controller
{

    public function gold_product()
    {
        try {
            $package = Package::with('trans')->where('type', 'gold')->first();
            $datePackageProducts = DatePackageProduct::with('packageApi')->active(1)->where('package_id', $package->id)->get();
            $productIds = $datePackageProducts->pluck('product_id')->toArray();
            $units = Product::query()->with(['datePackageProduct'])->whereIn('id', $productIds)->get();
            if ($units->isEmpty()) {
                // No cities found, return appropriate response
                return response()->json(['message' => 'No units  found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return  UnitResource::collection($units);
            // return response()->json($units );

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve products', 'error' => $e->getMessage(), 'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function silver_product()
    {
        try {

            $package = Package::with('trans')->where('type', 'silver')->first();
            $datePackageProducts = DatePackageProduct::with('packageApi')->active(1)->where('package_id', $package->id)->get();
            $productIds = $datePackageProducts->pluck('product_id')->toArray();
            $units  = Product::query()->with(['datePackageProduct'])->whereIn('id', $productIds)->get();
            if ($units->isEmpty()) {
                // No cities found, return appropriate response
                return response()->json(['message' => 'No units  found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return  UnitResource::collection($units);
            // return response()->json($units );

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve units ', 'error' => $e->getMessage(), 'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }


    public function bronze_product()
    {
        try {
            $package = Package::with('trans')->where('type', 'bronze')->first();
            $datePackageProducts = DatePackageProduct::with('packageApi')->active(1)->where('package_id', $package->id)->get();
            $productIds = $datePackageProducts->pluck('product_id')->toArray();
            $units  = Product::query()->with(['datePackageProduct'])->whereIn('id', $productIds)->get();
            if ($units->isEmpty()) {
                // No cities found, return appropriate response
                return response()->json(['message' => 'No units  found'], JsonResponse::HTTP_NOT_FOUND);
            }
            return  UnitResource::collection($units);
            // return response()->json($units );

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve units ', 'error' => $e->getMessage(), 'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            $units  = Product::query()->with(['datePackageProduct.packageApi', 'trans_api', 'category', 'country', 'state', 'city', 'district', 'images', 'property', 'viewproducts', 'wishlists', 'user'])->active(1)->findOrFail($id);
            return new UnitResource($units);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve units ', 'error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
//, 'trans_api', 'category', 'country', 'state', 'city', 'district', 'images', 'property', 'viewproducts', 'wishlists', 'user'
