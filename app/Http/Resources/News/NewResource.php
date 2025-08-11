<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewResource extends JsonResource
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
            'images' => NewAttachmentResource::collection($this->whenLoaded('images')),
            'data_trans' => NewTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'categories' => CategoryNewResource::collection($this->whenLoaded('categories')),
            'tags' => TagNewResource::collection($this->whenLoaded('tags')),
        ];
    }
}
