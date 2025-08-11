<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'data_trans' => CityTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'state' => StateResource::make($this->whenLoaded('state')),
            'country' => CountryResource::make($this->whenLoaded('country')),
        ];
    }
}
