<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Request;
use App\Models\ServiceTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = ServiceTranslation::where('service_id', $this->service_id)->get();

        $translationData = [];

        // Loop through each translation
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
                'description'.'_'.$item->locale => $item->description,
            ];
        }

        return $translationData;
    }
}