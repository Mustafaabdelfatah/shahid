<?php
namespace App\Http\Resources\News;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewAttachmentResource extends JsonResource
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
            'image' => $this->image,
        ];
    }
}