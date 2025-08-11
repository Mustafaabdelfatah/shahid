<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'logo_web' => $this->logo_web,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
            'whatsapp' => $this->whatsapp,
            'telegram' => $this->telegram,
            'github' => $this->github,
            'vimeo' => $this->vimeo,
            'tiktok' => $this->tiktok,
            'snapchat' => $this->snapchat,
            'pinterest' => $this->pinterest,
            'map' => $this->map,
            'address' => $this->address,
            'favicon_web' => $this->favicon_web,
            'data_trans' => SettingTranslationResource::collection($this->whenLoaded('trans'))->first(),
        ];
    }
}
