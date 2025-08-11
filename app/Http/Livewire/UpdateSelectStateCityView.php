<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;

class UpdateSelectStateCityView extends Component
{
    public  $countries;
    public  $cities;
    public $selectCountry = null;
    public $states;
    public function mount(){

       $this->countries =  Country::query()->with(['trans'])->get();

       if ($this->cities) {
           $this->selectCountry = $this->cities->country_id;
           $this->states = State::query()->with('trans')->where('country_id', $this->selectCountry)->get();
       }
    }
    public function render()
    {
        return view('livewire.update-select-state-city-view');
    }
    public function updatedSelectCountry(){

        $this->states = State::query()->with('trans')->where('country_id',$this->selectCountry)->get();

    }
}
