<?php

namespace App\Http\Controllers\Publisher\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publisher\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->where('parent_id', Auth::user()->id)->get();

        return view('publisher.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $roles = Role::query()->where('guard_name', 'web')->get();
        return view('publisher.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->getSanitized();
        $user = User::create($data);

        // $user->assignRole($data['roles']);
        return redirect()->back()->with('success', __('Created Sucessfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('publisher.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->getSanitized();
        $user = User::findOrFail($id);
        if ($request->password == null) {
            $data['password'] = $user->password;
        }
        // $user->syncRoles($data['roles']);
        $user->update($data);

        return redirect()->back()->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function update_status($id)
    {
        $user = User::findOrFail($id);
        $user->status == 1 ? $user->status = 0 : $user->status = 1;
        $user->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }
}
