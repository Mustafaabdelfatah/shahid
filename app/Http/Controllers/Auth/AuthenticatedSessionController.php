<?php

namespace App\Http\Controllers\Auth;

use App\Models\TeamUser;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $loginRequest = new LoginRequest();
        $loginRequest->authenticate($request);
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Authentication successful
            $user = Auth::user();
            if (($user->role === 'broker' || $user->role === 'agency') && $user->status === 1) {
                // Broker or agency with status 1 can login
                return redirect()->intended(RouteServiceProvider::HOME);
            } elseif ($user->role == 'employee' && $user->status == 1) {
                // Check if the user's ID exists in the team_users table
                $teamUser = TeamUser::where('user_id', $user->id)->exists();
                // dd($teamUser);
                if ($teamUser) {
                    return redirect()->intended(RouteServiceProvider::HOME);
                    // Employee with status 1 and existing ID in team_users can login
                } else {
                    // If the user's ID does not exist in team_users, logout and throw validation exception
                    Auth::logout();
                    throw ValidationException::withMessages([
                        'email' => __('auth.failed'),
                    ]);
                }
            } else {
                // If the user's role or status doesn't match, logout and throw validation exception
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        }

        // If authentication fails, throw validation exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
