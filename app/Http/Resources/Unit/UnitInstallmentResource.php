<?php
namespace App\Http\Resources\Unit;


use Illuminate\Http\Request;
use App\Http\Resources\Unit\UnitListResource;
use App\Http\Resources\Deposit\DepositResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Unit\AttachmentUintResource;
use App\Http\Resources\Unit\UnitTranslationResource;

class UnitInstallmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'deposit' => number_format($this->deposit, 0, '', ''),
            'monthly_installment' => number_format($this->monthly_installment, 0, '', ''),
            'years' => $this->years,
            'unit' => new UnitListResource($this->whenLoaded('product')),
        ];
    }
}

