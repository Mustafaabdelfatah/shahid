<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use App\Models\TypesUnitTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class Type_unitTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = TypesUnitTranslation::where('types_unit_id', $this->types_unit_id)->get();
        $translationData = [];
        foreach ($translations as $item) {
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;    }
}
