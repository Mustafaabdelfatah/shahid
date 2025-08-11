<?php

namespace App\Http\Resources\CategoryService;

use Illuminate\Http\Request;
use App\Models\CategoryServiceTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryServiceResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = CategoryServiceTranslation::where('category_service_id', $this->category_service_id)->get();
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}