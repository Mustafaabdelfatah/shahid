<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'agency@agency.com')->get()->first();
        $broker = User::query()->where('email', 'broker@broker.com')->get()->first();
        if ($user == null) {
            $user = User::create([
                'name' => 'agency',
                'email' => 'agency@agency.com',
                'password' => '123456789',
                'role' => 'agency',
                'status' => 1,
            ]);
        }

        $user->syncRoles(['admin']);
        $broker = User::create([
            'name' => 'broker',
            'email' => 'broker@broker.com',
            'password' => '123456789',
            'role' => 'broker',
            'status' => 1,
        ]);
        $broker->syncRoles(['admin']);
    }
}
