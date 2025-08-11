<?php

namespace App\Http\Resources\News;

use App\Models\TagNewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagNewTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = TagNewsTranslation::where('tag_news_id', $this->tag_news_id)->get();
        $translationData = [];
        foreach ($translations as $item) {
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}
