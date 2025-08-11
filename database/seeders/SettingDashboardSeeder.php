<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use App\Models\SettingDashboard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingDashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1], // Update or create condition
            [
                'type' => 'dashboard',
            ]
        );
    }
}
