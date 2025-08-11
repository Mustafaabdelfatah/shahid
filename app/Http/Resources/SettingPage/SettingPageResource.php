<?php

namespace App\Http\Resources\SettingPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_section' => $this->title_section,
            'image' => $this->image,
            'url_video' => $this->url_video,
            'data_trans' => SettingPageTranslationResource::collection($this->trans)->first(),

        ];
    }
}
