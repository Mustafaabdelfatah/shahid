<?php

namespace App\Http\Controllers\Admin\User;


use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = Admin::query()
            ->withCount('products')
            ->paginate($this->pagination_count);

        return view('admin.pages.admins.index', compact('users'));

    }
    public function showUnits(Admin $Admin)
    {
        $products = Product::where('admin_id', $Admin->id)->get();
        $categories = Category::query()->with('trans')->get();

        return view('admin.pages.admins.units', compact('products', 'Admin', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::query()->where('guard_name', 'admin')->get();

        return view('admin.pages.admins.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->getSanitized();
        $admin = Admin::create($data);
        $admin->assignRole($data['roles']);
        session()->flash('success', __('Created Sucessfully'));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::query()->where('guard_name', 'admin')->get();

        return view('admin.pages.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->getSanitized();
        $admin->update($data);
        $admin->syncRoles($data['roles']);
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Delete related records (e.g., roles, permissions, etc.)
        $admin->roles()->delete(); // Example, replace 'roles' with your actual relationship

        // Now delete the admin itself
        $admin->delete();

        session()->flash('success', __('Deleted Successfully'));

        return redirect()->route('admin.admins.index');
    }

    public function update_status($id)
    {
        $user = Admin::findOrfail($id);
        $user->status == 1 ? $user->status = 0 : $user->status = 1;
        $user->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
            $Admin = Admin::findMany($request['record']);
            foreach ($Admin as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $Admin = Admin::findMany($request['record']);
            foreach ($Admin as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $Admin = Admin::findMany($request['record']);
            foreach ($Admin as $item) {
                $item->delete();
            }

            return redirect()->route('admin.admins.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}