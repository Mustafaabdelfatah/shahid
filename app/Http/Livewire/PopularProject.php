<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Project;
use Livewire\Component;

class PopularProject extends Component
{
    public $selectCity = null;

    public $cities;

    public $projctes;

    public function mount()
    {
        $this->cities = City::query()->with(['trans'])->get();
    }

    public function render()
    {
        return view('livewire.popular-project');
    }

    public function updatedSelectCity()
    {
        $this->projctes = Project::query()->with('trans')->active(1)->where('city_id', $this->selectCity)->get();
    }
}
