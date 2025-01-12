<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActResource extends JsonResource
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
            'date_start'=>$this->date_start,
            'date_end'=>$this->date_end,
            'project_id'=>$this->project_id ?? null,
            'contract_id'=>$this->contract_id ?? null,
            'building_object_id'=>$this->buildingObjects->first()->id ?? null,
            'certificate_id'=>$this->certifications->first()->id ?? null,

        ];
    }
}
