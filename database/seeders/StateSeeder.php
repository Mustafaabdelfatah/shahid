<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $req = [
            $Cairo = [
                'en' => [ 
                    'title' => 'Cairo',
                ],
                'ar' => [   
                    'title' =>'القاهرة',
                ],
            ],
            $Giza = [
                'en' => [ 
                    'title' => 'Giza',
                 
                ],
                'ar' => [   
                    'title' =>'الجيزة',
                ],
            ],
            $Alexandria = [
                'en' => [ 
                    'title' => 'Alexandria',
                 
                ],
                'ar' => [   
                    'title' =>'الأسكندرية',
                ],
            ],
            $Dakahlia = [
                'en' => [ 
                    'title' => 'Dakahlia',
                 
                ],
                'ar' => [   
                    'title' =>'الدقهلية',
                ],
            ],
            $Red_Sea = [
                'en' => [ 
                    'title' => 'Red Sea',
                 
                ],
                'ar' => [   
                    'title' =>'البحر الأحمر',
                ],
            ],
            $Beheira = [
                'en' => [ 
                    'title' => 'Beheira',
                 
                ],
                'ar' => [   
                    'title' =>'البحيرة',
                ],
            ],
            $Fayoum = [
                'en' => [ 
                    'title' => 'Fayoum',
                 
                ],
                'ar' => [   
                    'title' =>'الفيوم',
                ],
            ],
            $Gharbiya = [
                'en' => [ 
                    'title' => 'Gharbiya',
                 
                ],
                'ar' => [   
                    'title' =>'الغربية',
                ],
            ],
            $Ismailia = [
                'en' => [ 
                    'title' => 'Ismailia',
                 
                ],
                'ar' => [   
                    'title' =>'الإسماعلية',
                ],
            ],
            $Menofia = [
                'en' => [ 
                    'title' => 'Menofia',
                 
                ],
                'ar' => [   
                    'title' =>'المنوفية',
                ],
            ],
            $Minya = [
                'en' => [ 
                    'title' => 'Minya',
                 
                ],
                'ar' => [   
                    'title' =>'المنيا',
                ],
            ],
            $Qaliubiya = [
                'en' => [ 
                    'title' => 'Qaliubiya',
                 
                ],
                'ar' => [   
                    'title' =>'القليوبية',
                ],
            ],
            $New_Valley = [
                'en' => [ 
                    'title' => 'New Valley',
                 
                ],
                'ar' => [   
                    'title' =>'الوادي الجديد',
                ],
            ],
            $New_SuezValley = [
                'en' => [ 
                    'title' => 'Suez',
                 
                ],
                'ar' => [   
                    'title' =>'السويس',
                ]
            ],
            $Aswan = [
                'en' => [ 
                    'title' => 'Aswan',
                 
                ],
                'ar' => [   
                    'title' =>'اسوان',
                ],
            ],
            $Assiut = [
                'en' => [ 
                    'title' => 'Assiut',
                 
                ],
                'ar' => [   
                    'title' =>'اسيوط',
                ],
            ],
            $Beni_Suef = [
                'en' => [ 
                    'title' => 'Beni Suef',
                 
                ],
                'ar' => [   
                    'title' =>'بني سويف',
                ],
            ],
            $Port_Said = [
                'en' => [ 
                    'title' => 'Port Said',
                 
                ],
                'ar' => [   
                    'title' =>'بورسعيد',
                ],
            ],
            $Damietta = [
                'en' => [ 
                    'title' => 'Damietta',
                 
                ],
                'ar' => [   
                    'title' =>'دمياط',
                ],
            ],
            $Sharkia = [
                'en' => [ 
                    'title' => 'Sharkia',
                 
                ],
                'ar' => [   
                    'title' =>'الشرقية',
                ],
            ],
            $South_Sinai = [
                'en' => [ 
                    'title' => 'South Sinai',
                 
                ],
                'ar' => [   
                    'title' =>'جنوب سيناء',
                ],
            ],
            $Kafr_Al_sheikh = [
                'en' => [ 
                    'title' => 'Kafr Al sheikh',
                 
                ],
                'ar' => [   
                    'title' =>'كفر الشيخ',
                ],
            ],
            $Matrouh = [
                'en' => [ 
                    'title' => 'Matrouh',
                 
                ],
                'ar' => [   
                    'title' =>'مطروح',
                ],
            ],
            $Luxor = [
                'en' => [ 
                    'title' => 'Luxor',
                 
                ],
                'ar' => [   
                    'title' =>'الأقصر',
                ],
            ],
            $Qena = [
                'en' => [ 
                    'title' => 'Qena',
                 
                ],
                'ar' => [   
                    'title' =>'قنا',
                ],
            ],
            $North_Sinai = [
                'en' => [ 
                    'title' => 'North Sinai',
                 
                ],
                'ar' => [   
                    'title' =>'شمال سيناء',
                ],
            ],
            $Sohag = [
                'en' => [ 
                    'title' => 'Sohag',
                 
                ],
                'ar' => [   
                    'title' =>'سوهاج',
                ],
            ],

        // add countries 
    
          
        ];
        if(State::query()->get()->count() == 0){
            $country_id = 1;
            foreach ($req as $city => $rq) {
                // Add country_id to the $rq array
                $rq['country_id'] = $country_id;
                State::create($rq);
            }
        }
    }
}
