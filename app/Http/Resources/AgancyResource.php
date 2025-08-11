<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgancyResource extends JsonResource
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
            'whatsapp' => $this->whatsapp,
            'company_name' => $this->company_name,
            'description' => $this->bio,
            'address' => $this->address,
            'city' => $this->city,
            'website_link' => $this->website_link,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
            'telegram' => $this->telegram,
            'agency_image' => $this->agency_image,
            'project' => ProjectResource::collection($this->whenLoaded('projects')),

           
          
        ];
    }
}
