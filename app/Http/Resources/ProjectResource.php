<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'=>$this->id,
            'building_object_id'=>$this->building_object_id ?? 'Идентификатор объект не указан',
            'building_object_address' => $this->buildingObject?->address ?? 'Адрес не указан',
            'name'=>$this->name,
            'project_code'=>$this->project_code,
            'project_section'=>$this->project_section ?? 'Раздел не указан',
            'project_stage'=>$this->project_stage ?? 'Стадия не указана'
        ];
    }
}
