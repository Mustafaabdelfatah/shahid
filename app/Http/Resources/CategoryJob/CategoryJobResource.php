<?php
namespace App\Http\Resources\CategoryJob;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryJob\CategoryJobResourceTranslation;
use App\Http\Resources\Jobs\JobResource;

class CategoryJobResource extends JsonResource
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
            'data_trans' => $this->whenLoaded('trans') ? new CategoryJobResourceTranslation($this->trans->first()) : null,
            'Jobs' => JobResource::collection($this->whenLoaded('jobs')),
            'jobs_count' => $this->jobs()->count(),
        ];
    }
}