<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Product;
use Livewire\Component;

class PopularCity extends Component
{

    public $selectCity = null;
    public $cities;
    public $units;

    public function mount()
    {
        $this->cities =  City::query()->with(['trans'])->get();
    }
    public function render()
    {
        return view('livewire.popular-city');
    }

    public function updatedSelectCity()
    {
        $this->units = Product::query()->with('trans')->active(1)->where('city_id', $this->selectCity)->get();
    }
}
