<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\Profile\ProfileRequest;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {

        return view('admin.pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->save();
        session()->flash('success', trans('Updated Sucessfully'));
        return back();
    }
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
    

        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        Admin::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
