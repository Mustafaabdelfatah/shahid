<?php

namespace App\Http\Resources\Deposit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Unit\UnitInstallmentResource;

class DepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'price'=>$this->price,
            'unitInstallments' => UnitInstallmentResource::collection($this->whenLoaded('unitInstallments'))
        ];
    }
}
