<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'                                  => $this->name,
            'email'                                 => $this->email,
            'phone'                                 => $this->phone,
            'backup_number'                         => $this->backup_number,
            'address'                               => $this->address,
            'image'                                 => $this->image,
            'cover_image'                           => $this->cover_image,
            'bio'                                   => $this->bio,
            'city'                                  => $this->city,
            'company_name'                          => $this->company_name,
            'website_link'                          => $this->website_link,
            'whatsapp'                              => $this->whatsapp,
            'commercial_registration_no'            => $this->commercial_registration_no,
            'facebook'                              => $this->facebook,
            'twitter'                               => $this->twitter,
            'instagram'                             => $this->instagram,          
            'youtube'                               => $this->youtube,
            'linkedin'                              => $this->linkedin,        
            'telegram'                              => $this->telegram,
            'github'                                => $this->github,
            'vimeo'                                 => $this->vimeo,
            'tiktok'                                => $this->tiktok,
            'snapchat'                              => $this->snapchat,
            'pinterest'                             => $this->pinterest,
            'map'                                   => $this->map,
            'role'                                  => $this->role,
        ];
    }
}
