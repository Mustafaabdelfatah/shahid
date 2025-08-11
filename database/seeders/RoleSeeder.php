<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::query()->get();
        syncPermisions($permissions);
        // role adminstartor
        $administrator = Role::where('name', 'administrator')->get()->first();
        if ($administrator == null) {
            $administrator = Role::create([
                'name' => 'administrator',
                'guard_name' => 'admin'
            ]);
        }

        // sync role by permissions
        $administrator->syncPermissions(Permission::query()->where('guard_name', 'admin')->get()->pluck('id')->toArray());

        $admin = Role::where('name', 'admin')->get()->first();
        syncPermisionsPublisher($permissions);
        if ($admin == null) {
            $admin = Role::create([
                'name' => 'admin',
                'guard_name' => 'web'
            ]);
        }
        $admin->syncPermissions(Permission::query()->where('guard_name', 'web')->get()->pluck('id')->toArray());
    }
}
