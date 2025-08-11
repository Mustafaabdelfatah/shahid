<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 2], // Update or create condition
            [
                'type' => 'websit',
                'name' => 'Your Website Name',
                'email' => 'your@email.com',
                'phone' => '123456789',
                'address' => 'your address',
                'facebook' => 'your facebook',
                'twitter' => 'your twitter',
                'instagram' => 'your instagram',
                'youtube' => 'your youtube',
                'linkedin' => 'your linkedin',
                'whatsapp' =>'your whatsapp',
                'telegram' => 'your telegram',
                'github' => 'your github',
                'vimeo' => 'your vimeo',
                'tiktok' => 'your tiktok',
                'snapchat' => 'your snapchat',
                'pinterest' => 'your pinterest',
                'map' => 'your map',
            ]
        );
    }
}
