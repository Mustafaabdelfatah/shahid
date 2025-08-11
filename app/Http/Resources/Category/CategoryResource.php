<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'sort' => $this->sort,
            'image' =>$this->image,
            'section_name' => $this->section_name,
            'data_trans' => CategoryTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'count_unit' => $this->units()->count(),
        ];
    }
}
