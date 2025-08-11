<?php

namespace App\Http\Resources\Unit;

use App\Models\ProductTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = ProductTranslation::where('product_id', $this->product_id)->get();
        $translationData = [];

        // Loop through each translation
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
                'slug'.'_'.$item->locale => $item->slug,
                'description'.'_'.$item->locale => $item->description,
                'meta_title'.'_'.$item->locale => $item->meta_title,
                'meta_description'.'_'.$item->locale => $item->meta_description,
                'meta_key'.'_'.$item->locale => $item->meta_key,
            ];
        }

        return $translationData;

    }
}
