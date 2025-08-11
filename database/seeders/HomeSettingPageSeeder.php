<?php

namespace Database\Seeders;

use App\Models\HomeSettingPage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomeSettingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $title_settings = [
        'home',
        'about',
        'vission',
        'mission',
        'our_message',
        'why_choose_us',     
        'contact_us',
        'footer',
        ];

        foreach($title_settings as $title){
            foreach(config('translatable.locales') as $locale){
                $dataTrans[$locale]['title'] = $title;
                $dataTrans[$locale]['description'] = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit praesentium blanditiis dolore repellat quam! Minima corporis corrupti blanditiis est in, atque excepturi, ipsam voluptate molestiae dignissimos magni recusandae praesentium modi.';
            }
            HomeSettingPage::create(['title_section'=>$title] + $dataTrans);
        }
    }
}
