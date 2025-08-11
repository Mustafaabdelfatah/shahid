<?php

namespace App\Http\Resources\Feature;

use Illuminate\Http\Request;
use App\Models\FeatureTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = FeatureTranslation::where('featur_id', $this->featur_id)->get();
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}