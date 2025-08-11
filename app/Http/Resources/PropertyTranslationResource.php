<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\propertyTranslation;
use App\Models\PropertyTypeTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $translations = PropertyTypeTranslation::where('property_id', $this->property_id)->get();
        $translationData = [];
        foreach ($translations as $item) {
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}