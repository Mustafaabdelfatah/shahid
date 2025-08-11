<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::query()->where('email', 'admin@admin.com')->get()->first();
        if ($admin == null) {
            $admin = Admin::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '123456789',
                'status' => 1,
            ]);
        }
        $admin->syncRoles(['administrator']);
    }
}
