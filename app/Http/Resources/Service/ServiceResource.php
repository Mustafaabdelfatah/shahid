<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Request;
use App\Http\Resources\Feature\FeatureResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Service\ServiceAttachmentResource;
use App\Http\Resources\Service\ServiceResourceTranslation;
use App\Http\Resources\CategoryService\CategoryServiceResource;

class ServiceResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'address'  => $this->address,
            'facebook' => $this->facebook,
            'twitter'=> $this->twitter ,
            'instagram' => $this->instagram,
            'map' => $this->map,
            'data_trans' => ServiceResourceTranslation::collection($this->whenLoaded('trans'))->first(),
            'images' => ServiceAttachmentResource::collection($this->whenLoaded('images')),
            'category' =>  new CategoryServiceResource($this->whenLoaded('category_service')),
            'features' => FeatureResource::collection($this->whenLoaded('features')),
        ];
    }
}