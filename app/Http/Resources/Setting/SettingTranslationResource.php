<?php

namespace App\Http\Resources\Setting;

use App\Models\SettingTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = SettingTranslation::where('setting_id', $this->setting_id)->get();
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'meta_title'.'_'.$item->locale => $item->meta_title,
                'meta_description'.'_'.$item->locale => $item->meta_description,
                'meta_key'.'_'.$item->locale => $item->meta_key,
            ];
        }

        return $translationData;
    }
}
