<?php
namespace App\Http\Resources\Offer;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Offer\OfferTranslationResource;

class OfferResource extends JsonResource
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
            'address'  => $this->address,
            'data_trans' => OfferTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'user' => $this->user
                ? new UserResource($this->user)
                : ($this->create_by ? new AdminResource($this->create_by) : null),
        ];
    }
}