<?php

namespace App\Http\Controllers\Api\Profile;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Profile\ProfileResource;

class ProfileController extends Controller
{
    const TOKEN_NAME = 'token';
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $products = Product::query()->with(['category', 'country', 'state', 'city', 'district', 'images', 'property', 'viewproducts', 'wishlists','datePackageProduct'])->where('user_id', $user->id)->get();
       
              return response()->json([
                'message' => 'Get all data successfully',
                'status' => JsonResponse::HTTP_OK,
                'data' =>  ProductResource::collection($products),
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function info_user(Request $request)
    {
        try {
            $user = $request->user();
           $user->load('units');
              return response()->json([
                'message' => 'Get all data successfully',
                'status' => JsonResponse::HTTP_OK,
                'data' => new  ProfileResource($user),
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }




    public function update(ProfileRequest $request)
    {
        try {
            $data = $request->validated();

            $user = $request->user();
            $token = $user->accessToken ?? null;
            // If the token doesn't exist, create a new one
            if (!$token) {
                $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;
            }
            $user->update($data);
            // Load the relationships if needed
            $user->load(['products' => ['category', 'country', 'state', 'city', 'district', 'images', 'property', 'viewproducts', 'wishlists']]);
            // Return the updated user data along with the token
            return response()->json([
                'message' => 'Update successfully',
                'status' => JsonResponse::HTTP_OK,
                'user' => new ProfileResource($user),
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
