<?php

namespace App\Http\Resources\Unit;

use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Http\Resources\Gate\GateResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Unit\UnitInstallmentResource;

class UnitListResource extends JsonResource
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
            'price' => $this->price,
            'finance' => $this->finance,
            'for_sale' => $this->for_sale,
            'service_charges' => $this->service_charges,
            'size' => $this->size,
            'rooms' => $this->rooms,
            'bathroom' => $this->bathroom,
            'location' => $this->location,
            'primum' => $this->primum,
            'type' => $this->type,
            'video' => $this->video,
            'code' => $this->code,
            'cover_image' => $this->plan,
            'paying' => $this->paying,
            'fawry' => $this->fawry,
            'delivery_date' => $this->delivery_date,
            'data_trans' => UnitTranslationResource::collection($this->trans)->first(),
            'images' => AttachmentUintResource::collection($this->whenLoaded('images')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'count_view' => $this->viewproducts()->count(),
            'count_wishlist' => $this->wishlists()->count(),
            'gates' => GateResource::collection($this->whenLoaded('gates')),
            'installments' => UnitInstallmentResource::collection($this->whenLoaded('installments')),
            'user' => $this->user
            ? new UserResource($this->user)
            : ($this->admin ? new AdminResource($this->admin) :null),
        ];
    }
}
