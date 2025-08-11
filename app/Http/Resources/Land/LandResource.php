<?php
namespace App\Http\Resources\Land;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Land\LandTranslationResource;

class LandResource extends JsonResource
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
            'price' => $this->price,
            'address'  => $this->address,
            'data_trans' => LandTranslationResource::collection($this->whenLoaded('trans'))->first(),
            'user' => $this->user
                ? new UserResource($this->user)
                : ($this->create_by ? new AdminResource($this->create_by) : null),
        ];
    }
}