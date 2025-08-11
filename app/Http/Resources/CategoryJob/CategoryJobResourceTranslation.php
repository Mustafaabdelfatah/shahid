<?php
namespace App\Http\Resources\CategoryJob;


use Illuminate\Http\Request;
use App\Models\CategoryJobTranslation;
use App\Models\CategoryServiceTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryJobResourceTranslation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = CategoryJobTranslation::where('category_job_id', $this->category_job_id)->get();
        foreach ($translations as $item) {
            // Add translation data to the array
            $translationData[] = [
                'title'.'_'.$item->locale => $item->title,
            ];
        }

        return $translationData;
    }
}