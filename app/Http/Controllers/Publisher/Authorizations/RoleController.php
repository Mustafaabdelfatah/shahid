<?php
namespace App\Http\Controllers\Publisher\Authorizations;

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
        syncPermisionsPublisher($model);
    }
    public function index()
    {
        $items = Role::query()->where('guard_name', 'web')->paginate($this->pagination_count);
        return view('publisher.pages.authorization.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::query()->where('guard_name', 'web')->get();
        return view('publisher.pages.authorization.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {
        $data = $request->getSanitized();
        $role = Role::create(['name' => $data['name']]);
        $role->permissions()->attach($data['permissions']);
        
        session()->flash('success',__('Created Sucessfully'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return view('publisher.pages.authorization.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        $permissions = Permission::query()->where('guard_name', 'web')->get();
        return view('publisher.pages.authorization.edit', compact('role', 'permissions'));
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
}
