<?php

namespace App\Http\Resources;

use App\Models\DistrictTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $translations = DistrictTranslation::where('district_id', $this->district_id)->get();
        $translationData = [];
        foreach ($translations as $item) {
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}
