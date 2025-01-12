<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExecutiveSchemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'code_scheme'=>$this->code_scheme,
            'description'=>$this->description,
            'number_of_act'=>$this->act?->id ?? 'Акт не указан',
        ];
    }
}
