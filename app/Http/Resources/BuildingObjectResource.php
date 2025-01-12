<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingObjectResource extends JsonResource
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
            'contract_id'=>$this->contract_id ?? null,
            'contract_type'=>$this->contract->contract_type ?? 'Тип контракта не указан',
            'address'=>$this->address
        ];
    }
}
