<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $req = [
            $egypt = [
                'en' => [ 
                    'title' => 'Egypt',
                 
                ],
                'ar' => [   
                    'title' =>'مصر',
                ],
            ],
        ];
        if(Country::query()->get()->count() == 0){
            foreach($req as $rq){
                Country::create($rq);
            }
        }
       

    }
}

