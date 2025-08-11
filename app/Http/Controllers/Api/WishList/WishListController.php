<?php

namespace App\Http\Controllers\Api\WishList;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishList\WishListResource;
use App\Models\WishList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $perPage = $request->input('per_page', 10); // Default per page is 10
            $user = auth()->user();
            $wishlist = $user->wishlist()->with(['product'])->get();
            if ($wishlist->isEmpty()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'No wishlist  found', []);

                // return response()->json(['error' => 'No wishlist found'], JsonResponse::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'data' => WishListResource::collection($wishlist),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve wishlist', 'error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->validate([
                'product_id' => 'required', 'integer', 'exists:products,id',
            ]);
            $data['user_id'] = $user->id;
            if (WishList::query()->where('product_id', $data['product_id'])->where('user_id', $user->id)->exists()) {
                return ApiResponse::apiResponse(JsonResponse::HTTP_OK, 'Wishlist already exists', []);
            }
            $wishlist = WishList::create($data);
            $wishlist->load('product');

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'data' => new WishListResource($wishlist),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $wishlist = WishList::findOrFail($id);
            $wishlist->load('product');

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'data' => new WishListResource($wishlist),
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Wishlist not found', 'status' => 422]);
        }

        // If wishlist exists, load related products and return the response

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the wishlist item by its ID
            $wishlistItem = WishList::where('product_id', $id)->first();

            // Delete the wishlist item
            $wishlistItem->delete();

            // Return a success response
            return response()->json(['message' => 'Wishlist item deleted successfully', 'status' => JsonResponse::HTTP_OK]);
        } catch (\Exception $e) {
            // Handle the case where the wishlist item does not exist
            return response()->json(['error' => 'Wishlist item not found', 'status' => JsonResponse::HTTP_NOT_FOUND]);
        }
    }
}
