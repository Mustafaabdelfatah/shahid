<?php

namespace App\Http\Resources\SettingPage;

use App\Models\HomeSettingPageTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingPageTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = HomeSettingPageTranslation::where('home_setting_id', $this->home_setting_id)->get();

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
