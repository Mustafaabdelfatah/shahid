<?php

namespace App\Http\Resources\Unit;

use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\Gate\GateResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\DataPackageProduct;
use App\Http\Resources\User\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Unit\UnitInstallmentResource;

class UnitResource extends JsonResource
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
            'building_number' => $this->building_number,
            'code' => $this->code,
            'price' => $this->price,
            'finance' => $this->finance,
            'service_charges' => $this->service_charges,
            'size' => $this->size,
            'status' => $this->status,
            'fawry' => $this->fawry,
            'delivery_date' => $this->delivery_date,
            'approve' => $this->approve,
            'paying' => $this->paying,
            'rooms' => $this->rooms,
            'bathroom' => $this->bathroom,
            'floor' => $this->floor,
            'expairday' => $this->expairday,
            'primum' => $this->primum,
            'location' => $this->location,
            'main_category' => $this->main_category,
            'type' => $this->type,
            'video' => $this->video,
            'cover_image' => $this->plan,
            'images' => AttachmentUintResource::collection($this->whenLoaded('images')),
            'data_trans' => UnitTranslationResource::collection($this->trans)->first(),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'property' => PropertyResource::collection($this->whenLoaded('property')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'state' => new StateResource($this->whenLoaded('state')),
            'city' => new CityResource($this->whenLoaded('city')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'count_view' => $this->viewproducts()->count(),
            'count_wishlist' => $this->wishlists()->count(),
            'package_date' => DataPackageProduct::collection($this->whenLoaded('datePackageProduct')),
            'installments' => UnitInstallmentResource::collection($this->whenLoaded('installments')),
            'gates' => GateResource::collection($this->whenLoaded('gates')),
            'user' => $this->user
            ? new UserResource($this->user)
            : ($this->admin ? new AdminResource($this->admin) :null),
        ];
    }
}
