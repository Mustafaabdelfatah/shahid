<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileInfo extends Component
{
    public $user;
    protected $listeners = ['profileUpdated'=> '$refresh'];
    public function render()
    {
        return view('livewire.profile-info');
    }
}
