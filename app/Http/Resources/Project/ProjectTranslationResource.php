<?php

namespace App\Http\Resources\Project;

use App\Models\ProjectTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = ProjectTranslation::where('project_id', $this->project_id)->get();

        $translationData = [];

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
