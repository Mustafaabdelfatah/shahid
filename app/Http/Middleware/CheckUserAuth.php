<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && in_array($user->role, ['broker', 'agency']) && $user->status == 1) {
            return $next($request); // User is authorized, proceed with the request
        }

        // If user is not authorized, throw an unauthorized exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
        Auth::guard('web')->logout();
    }
}
