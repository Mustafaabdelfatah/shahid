<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{
    const TOKEN_NAME = 'token';

    public function updatePassword(UpdatePasswordRequest $request)
    {
        // Validate the current password
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['error' => 'Current password is incorrect','status'=> JsonResponse::HTTP_NOT_FOUND ]);
        }

        // Update the password and fetch the updated user object
        $user = auth()->user();
        $user->update([
            'password' => $request->password,
        ]);

        // Retrieve the token
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;

        return response()->json([
            'message' => 'Password updated successfully',
            'status' => JsonResponse::HTTP_OK,
            'token' => $token
        ]);
    }
}

