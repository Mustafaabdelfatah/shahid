<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $req = [
            $gold = [
                'en' => [
                    'title' => 'Gold',
                ],
                'ar' => [
                    'title' => 'ذهبي',
                ],
            ],
            $bronze = [
                'en' => [
                    'title' => 'Bronze',
                ],
                'ar' => [
                    'title' => 'برونزية',
                ],
            ],
            $silver = [
                'en' => [
                    'title' => 'Silver',
                ],
                'ar' => [
                    'title' => 'سيلفر',
                ],
            ],

            $normal = [
                'en' => [
                    'title' => 'Normal',
                ],
                'ar' => [
                    'title' => 'طبيعي',
                ],
            ],


        ];
        $type = [
            'gold',
            'bronze',
            'silver',
            'normal'
        ];

        if (Package::query()->get()->count() == 0) {
            foreach ($req as $key => $rq) {
                Package::create(['type' => $type[$key]] + $rq);
            }
        }
    }
}
