<?php

namespace App\Http\Resources\CategoryService;

use Illuminate\Http\Request;
use App\Http\Resources\Service\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryService\CategoryServiceResourceTranslation;

class CategoryServiceResource extends JsonResource
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
            'image' => $this->image,
            'data_trans' => CategoryServiceResourceTranslation::collection($this->whenLoaded('trans'))->first(),
            'Services' => ServiceResource::collection($this->whenLoaded('services')),
            'services_count' => $this->services()->count(),
        ];
    }
}   