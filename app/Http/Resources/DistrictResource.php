<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'data_trans' => DistrictTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'city' => CityResource::make($this->whenLoaded('city')),
            'state' => StateResource::make($this->whenLoaded('state')),
            'country' => CountryResource::make($this->whenLoaded('country')),
        ];
    }
}
