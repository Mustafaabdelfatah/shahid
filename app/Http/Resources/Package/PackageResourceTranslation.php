<?php

namespace App\Http\Resources\Package;

use App\Models\PackageTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = PackageTranslation::where('package_id', $this->package_id)->get();
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
