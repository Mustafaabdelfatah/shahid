<?php

namespace App\Http\Resources\Gate;

use Illuminate\Http\Request;
use App\Http\Resources\Unit\UnitResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Gate\GateResourceTranslation;

class GateResource extends JsonResource
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
            'data_trans' => GateResourceTranslation::collection($this->trans)->first(),
            'units' => UnitResource::collection($this->products)->count(), 
        ];
    }
}