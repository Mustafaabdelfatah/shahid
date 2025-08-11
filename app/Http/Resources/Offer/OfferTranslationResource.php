<?php
namespace App\Http\Resources\Offer;


use Illuminate\Http\Request;
use App\Models\OffersTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = OffersTranslation::where('offers_id', $this->offers_id)->get();

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