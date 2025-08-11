<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Project\Type_unitTranslationResource;


class ProjectType_unitResource extends JsonResource
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
            'data_trans' => Type_unitTranslationResource::collection($this->whenLoaded('trans'))->first(),

        ];
    }
}
