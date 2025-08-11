<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\Package\PackageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DataPackageProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'package' => new  PackageResource($this->whenLoaded('packageApi')),
        ];
    }
}
