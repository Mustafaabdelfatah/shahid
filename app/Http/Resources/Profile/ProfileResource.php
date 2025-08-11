<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use App\Http\Resources\Unit\UnitResource;
use App\Http\Resources\Prodcut\ProdcutResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'phone' => $this->phone,
        'address'=>$this->address ,
        'image' => $this->image,
        'cover_image' => $this->cover_image,
        'bio' => $this->bio,
        'city' => $this->city,
        'company_name' => $this->company_name,
        'website_link' => $this->website_link,
        'whatsapp' => $this->whatsapp,
        'commercial_registration_no' => $this->commercial_registration_no,
        'facebook' => $this->facebook,
        'twitter' => $this->twitter,
        'instagram' => $this->instagram,
        'youtube' => $this->youtube,
        'linkedin' => $this->linkedin,
        'telegram' => $this->telegram,
        'github' => $this->github,
        'vimeo' => $this->vimeo,
        'tiktok' => $this->tiktok,
        'snapchat' => $this->snapchat,
        'pinterest' => $this->pinterest,
        'updated_by' => $this->updated,
        'role' => $this->role,
        'list' => UnitResource::collection($this->whenLoaded('units')),
        ];
    }
}
