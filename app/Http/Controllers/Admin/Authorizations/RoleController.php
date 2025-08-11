<?php

namespace App\Http\Controllers\Admin\Authorizations;



use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $model = Permission::query()->get();
        syncPermisions($model);
    }
    public function index()
    {
        $items = Role::query()->where('guard_name', 'admin')->paginate($this->pagination_count);
        return view('admin.pages.authorization.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::query()
            ->where('guard_name', 'admin')
            ->get()
            ->sortBy(function ($permission) {
                return transPermission($permission->name);
            });
        return view('admin.pages.authorization.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {
        $data = $request->getSanitized();
        $role = Role::create(['name' => $data['name']]);
        $role->permissions()->attach($data['permissions']);
        session()->flash('success', __('Created Sucessfully'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.pages.authorization.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        $permissions = Permission::query()
            ->where('guard_name', 'admin')
            ->get()
            ->sortBy(function ($permission) {
                return transPermission($permission->name);
            });
        return view('admin.pages.authorization.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesRequest $request, Role $role)
    {


        $role->update($request->getSanitized());
        $role->syncPermissions($request->getSanitized()['permissions']);
        session()->flash('success', __('Updated Sucessfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (\Exception $e) {
        }
        session()->flash('success', __('Deleted Sucessfully'));

        return back();
    }
    public function actions(Request $request)
    {
       
        if ($request['publish'] == 1) {
            $role = Role::findMany($request['record']);
            foreach ($role as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $role = Role::findMany($request['record']);
            foreach ($role as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $role = Role::findMany($request['record']);
            foreach ($role as $item) {
                $item->delete();
            }

            return redirect()->route('admin.roles.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
