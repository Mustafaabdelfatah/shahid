<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.pages.profile.edit', compact('user'));
    }

    public function update(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.password.change')->with('success', 'Password changed successfully.');
    }
}
