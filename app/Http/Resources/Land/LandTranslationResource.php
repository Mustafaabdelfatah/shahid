<?php
namespace App\Http\Resources\Land;

use App\Models\LandTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LandTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = LandTranslation::where('land_id', $this->land_id)->get();

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