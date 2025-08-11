<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Product;
use Livewire\Component;

class UpdatePopularCity extends Component
{
    public $selectCity = null;
    public $cities;
    public $units;
    public $selectUnits  = [];
    public $popularCity;
    public function mount()
    {
        $this->cities = City::query()->with(['trans'])->get();

        // Assume popularCity is passed as a property or loaded within the component
        if ($this->popularCity) {
            $this->selectCity = $this->popularCity->city_id;
            // Ensure popular_city_unit relationship is loaded
            if ($this->popularCity->relationLoaded('popular_city_unit')) {
                // Directly pluck the ids from the relationship collection
                $this->selectUnits = $this->popularCity->popular_city_unit->pluck('unit_id')->toArray();
            } else {
                $this->selectUnits = [];
            }
            // Load units based on the selected unit ids
            $this->units = Product::query()->with('trans')->active(1)->whereIn('id', $this->selectUnits)->get();
        } else {
            $this->selectUnits = [];
            $this->units = [];
        }
    }


    public function render()
    {
        return view('livewire.update-popular-city');
    }
    public function updatedSelectCity()
    {
        $this->units = Product::query()->with('trans')->active(1)->where('city_id', $this->selectCity)->get();
    }
}
