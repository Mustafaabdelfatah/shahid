<?php
namespace App\Http\Resources\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryJob\CategoryJobResource;

class JobResource extends JsonResource
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
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'address' => $this->address,
            'description' => $this->description,
            'category' => new CategoryJobResource($this->whenLoaded('categoryJob')),
            'category_id' => $this->category_job_id,
        ];
    }
}