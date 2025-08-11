<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\Mall\MallResource;
use App\Http\Resources\Unit\UnitResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\AdminResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Project\ProjectType_unitResource;
use App\Http\Resources\Project\ProjectInstallmentResource;
use App\Http\Resources\Project\ProjectTranslationResource;

class ProjectResource extends JsonResource
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
            'delivery_date' => $this->delivery_date,
            'construction_status' => $this->construction_status,
            'method_payment' => $this->method_payment,
            'price' => $this->price,
            'spaces' => $this->spaces,
            'finance' => $this->finance,
            'finish_type' => $this->finish_type,
            'cover_image' => $this->cover,
            'address' => $this->address,
            'data_trans' => ProjectTranslationResource::collection($this->trans)->first(),
            'units' => UnitResource::collection($this->whenLoaded('units')),
            'images' => ProjectAttachmentsResource::collection($this->whenLoaded('attachments')),
            'type_units' => ProjectType_unitResource::collection($this->whenLoaded('type_units')),
            'installments' => ProjectInstallmentResource::collection($this->whenLoaded('installments')),
            'facilities' => PropertyResource::collection($this->whenLoaded('property')),
            'avilable_units' => $this->units()->with('category')->get()->groupBy('category_id')->map(function ($units, $categoryId) {
                return [
                    'category_id' => $categoryId,
                    'units_count' => $units->count(),
                ];
            })->values()->toArray(),
            'Developer_name' => $this->user
                ? new UserResource($this->user)
                : ($this->admin ? new AdminResource($this->admin) : null),
        ];
    }

}
