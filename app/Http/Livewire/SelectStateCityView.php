<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class SelectStateCityView extends Component
{
  public  $countries;
  public $selectCountry = null;
  public $states;
  public function mount(){
    return $this->countries =  Country::query()->with(['trans'])->get();
  }
    public function render()
    {
        return view('livewire.select-state-city-view');
    }

    public function updatedSelectCountry(){

        $this->states = State::query()->with('trans')->where('country_id',$this->selectCountry)->get();
    
    }
}
