<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\District;

class SelectCountryProduct extends Component
{

    public  $countries;
    public $selectCountry = null;
    public $selectState = null;
    public $selectCity = null;
    public $states;
    public $stateIds;
    public $cities;
    public $districts;
    public function mount()
    {
        $this->countries =  Country::query()->with(['trans'])->get();
    }
    public function render()
    {
        return view('livewire.select-country-product');
    }
    public function updatedSelectCountry()
    {
        $this->states = State::query()->with('trans')->where('country_id', $this->selectCountry)->get();
    }

    public function updatedSelectState()
    {
        $this->cities = City::query()->with('trans')->where('state_id', $this->selectState)->get();
    }
    public function updatedSelectCity()
    {
        $this->districts = District::query()->with('trans')->where('city_id', $this->selectCity)->get();
    }
}
