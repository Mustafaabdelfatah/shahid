<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $req = [
            $apartments = [
                'en' => [
                    'title' => 'apartments',
                ],
                'ar' => [
                    'title' => 'شقق',
                ],

            ],
            $duplexes = [
                'en' => [
                    'title' => 'duplexes',
                ],
                'ar' => [
                    'title' => 'دوبلكس',
                ],
            ],
            $land = [
                'en' => [
                    'title' => 'land',
                ],
                'ar' => [
                    'title' => 'اراضي',
                ],
            ],
            $palaces = [
                'en' => [
                    'title' => 'palaces',
                ],
                'ar' => [
                    'title' => 'قصور',
                ],
            ],
            $bulk_sale_units = [
                'en' => [
                    'title' => 'bulk sale units',
                ],
                'ar' => [
                    'title' => 'اراضي',
                ],
            ],
            $villas = [
                'en' => [
                    'title' => 'villas',
                ],
                'ar' => [
                    'title' => 'بيوت وفلل',
                ],
            ],
            $twin_houses = [
                'en' => [
                    'title' => 'twin houses',
                ],
                'ar' => [
                    'title' => 'منازل مزدوجة',
                ],
            ],
            $hotel_apartments = [
                'en' => [
                    'title' => 'hotel apartments',
                ],
                'ar' => [
                    'title' => 'شقق فندقية',
                ],
            ],
            $roofs = [
                'en' => [
                    'title' => 'roofs',
                ],
                'ar' => [
                    'title' => 'اسطح',
                ],
            ],
            $half_floors = [
                'en' => [
                    'title' => 'half floors',
                ],
                'ar' => [
                    'title' => 'نصف طابق',
                ],
            ],
            $chalets = [
                'en' => [
                    'title' => 'chalets',
                ],
                'ar' => [
                    'title' => 'شاليهات',
                ],
            ],
            $penthouses = [
                'en' => [
                    'title' => 'penthouses',
                ],
                'ar' => [
                    'title' => 'بنتاوس',
                ],
            ],
            $whole_buildings = [
                'en' => [
                    'title' => 'whole buildings',
                ],
                'ar' => [
                    'title' => 'عمائر',
                ],
            ],
            $bungalows = [
                'en' => [
                    'title' => 'bungalows',
                ],
                'ar' => [
                    'title' => 'بانجلو',
                ],
            ],
            $townhouses = [
                'en' => [
                    'title' => 'townhouses',
                ],
                'ar' => [
                    'title' => 'تاون هاوس',
                ],
            ],
            $ivillas = [
                'en' => [
                    'title' => 'Ivillas',
                ],
                'ar' => [
                    'title' => 'اي فبلا',
                ],
            ],            
            $cabins = [
                'en' => [
                    'title' => 'cabins',
                ],
                'ar' => [
                    'title' => 'كبينات',
                ],
            ],
            $full_floors = [
                'en' => [
                    'title' => 'full floors',
                ],
                'ar' => [
                    'title' => 'طوابق كاملة',
                ],
            ],
        ];

        $section_name = [
            'apartments',
            'duplexes',
            'land',
            'palaces',
            'bulk sale units',
            'villas',
            'twin houses',
            'hotel apartments',
            'roofs',
            'half floors',
            'chalets',
            'penthouses',
            'whole buildings',
            'bungalows',
            'townhouses',
            'ivillas',
            'cabins',
            'full floors',
        ];


        if (Category::query()->get()->count() == 0) {
            foreach ($req as $key => $rq) {
                Category::create(['section_name' => $section_name[$key]] + $rq);
            }
        }
    }
}
