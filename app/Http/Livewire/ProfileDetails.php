<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileDetails extends Component
{
    use WithFileUploads;
    public $user;
    public $name, $email, $phone, $positions, $country, $city, $cover_image, $image, $bio;
    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->positions = $this->user->positions;
        $this->country = $this->user->country;
        $this->city = $this->user->city;
        $this->cover_image = $this->user->cover_image;
    }
    public function render()
    {
        return view('livewire.profile-details');
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $this->user->id,
            'phone' => 'required|string|max:255',
            'positions' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'cover_image' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
        ];
    }
    public function update()
    {
        $validatedData = $this->validate();
        $this->user->update($validatedData);
        session()->flash('success', __('Profile updated successfully.'));
        $this->emit('profileUpdated');
    }
}
