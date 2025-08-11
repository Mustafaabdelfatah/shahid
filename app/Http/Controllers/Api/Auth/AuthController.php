<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Notifications\RegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    const TOKEN_NAME = 'token';
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Determine if login is by email or phone
        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        // Attempt to authenticate user
        if (! Auth::attempt($credentials)) {
            RateLimiter::hit($this->throttleKey($request));

            return response()->json(['error' => 'Incorrect Email or Password'], 400);
        }

        $user = Auth::user();

        // Check if the user's status is not equal to 1
        if ($user->status !== 1) {
            Auth::logout();

            return response()->json(['error' => 'Account is inactive'], 403);
        }

        $user->notify(new LoginNotification($user));
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;
        $cookie = cookie('token', $token, 60 * 24 * 30); // Token cookie for 30 days

        RateLimiter::clear($this->throttleKey($request));

        return response()->json([
            'message' => 'Login successful',
            'status' => JsonResponse::HTTP_OK,
            'user' => $user,
            'token' => $token,
        ])->withCookie($cookie);
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('login')).'|'.$request->ip();
    }

    public function register(Request $request)
    {
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a string.',
            'between' => 'The :attribute must be between :min and :max characters.',
            'email' => 'The :attribute must be a valid email address.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'unique' => 'The :attribute has already been taken.',
            'min' => 'The :attribute must be at least :min characters.',
            'confirmed' => 'The Passwords do not match.',
        ];
        // Validate the request data with custom messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:10|max:15',
        ], $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => 'client',
        ]);

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

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $cookie = Cookie::forget('token');

        return response()->json(['message' => 'Logged out successfully']);
    }
}
