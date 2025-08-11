<?php

namespace App\Http\Resources\News;

use App\Models\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = NewsTranslation::where('news_id', $this->news_id)->get();
        $translationData = [];
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
                'sub_title'.'_'.$item->locale => $item->sub_title,
                'description'.'_'.$item->locale => $item->description,
                'meta_title'.'_'.$item->locale => $item->meta_title,
                'meta_description'.'_'.$item->locale => $item->meta_description,
                'meta_key'.'_'.$item->locale => $item->meta_key,
            ];
        }

        return $translationData;

    }
}
