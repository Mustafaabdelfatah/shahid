<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Http\JsonResponse;

class RegisterPublisherController extends Controller
{
    const TOKEN_NAME = 'token';

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);
        // $user->syncRoles(['admin']);
        // Generate token for the registered user
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;
        $cookie = cookie('token', $token, 60 * 24 * 30);
        $user->notify(new RegisterNotification($user));

        return response()->json([
            'message' => 'User registered successfully',
            'status' => JsonResponse::HTTP_CREATED,
            'user' => $user,
            'token' => $token,
        ])->withCookie($cookie);
    }
}
