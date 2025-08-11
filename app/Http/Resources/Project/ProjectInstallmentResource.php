<?php
namespace App\Http\Resources\Project;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Unit\AttachmentUintResource;
use App\Http\Resources\Unit\UnitTranslationResource;

class ProjectInstallmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'deposit' => $this->deposit,
            'monthly_installment' => $this->monthly_installment,
            'years' => $this->years,
        ];
    }
}
