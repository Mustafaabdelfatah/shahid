<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;
use App\Models\DatePackage;

class PackageSelect extends Component
{
    public $packages;
    public $selectPackage = null;
    public $data_packages;


    public function mount()
    {

        $this->packages = Package::query()->with('trans')->active(1)->whereNot('type', 'normal')->get();
    }
    public function render()
    {
        return view('livewire.package-select');
    }

    public function updatedSelectPackage()
    {
        $this->data_packages = DatePackage::query()->where('package_id', $this->selectPackage)->get();
    }
}
