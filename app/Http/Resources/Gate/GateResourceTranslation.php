<?php

namespace App\Http\Resources\Gate;

use Illuminate\Http\Request;
use App\Models\GatesTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class GateResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = GatesTranslation::where('gates_id', $this->gates_id)->get();

        $translationData = [];

        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}