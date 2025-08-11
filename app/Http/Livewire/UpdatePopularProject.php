<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Project;
use Livewire\Component;

class UpdatePopularProject extends Component
{
    public $selectCity = null;
    public $cities;
    public $projctes;
    public $selectProject  = [];
    public $popularCity;
    public function mount()
    {
        $this->cities = City::query()->with(['trans'])->get();

        // Assume popularCity is passed as a property or loaded within the component
        if ($this->popularCity) {
            $this->selectCity = $this->popularCity->city_id;
            // Ensure popular_city_unit relationship is loaded
            if ($this->popularCity->relationLoaded('popular_city_project')) {
                // Directly pluck the ids from the relationship collection
                $this->selectProject = $this->popularCity->popular_city_project->pluck('project_id')->toArray();
            } else {
                $this->selectProject = [];
            }
            // Load units based on the selected unit ids
            $this->projctes = Project::query()->with('trans')->active(1)->whereIn('id', $this->selectProject)->get();
        } else {
            $this->selectProject = [];
            $this->projctes = [];
        }
    }
    public function render()
    {
        return view('livewire.update-popular-project');
    }
    public function updatedSelectCity()
    {
        $this->projctes = Project::query()->with('trans')->active(1)->where('city_id', $this->selectCity)->get();
    }
}
