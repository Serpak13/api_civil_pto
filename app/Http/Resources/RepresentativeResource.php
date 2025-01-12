<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepresentativeResource extends JsonResource
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
            'company_id'=>$this->company_id,
            'company_name'=>$this->company->name ?? 'Имя компании не указано',
            'name'=>$this->name,
            'role'=>$this->role,
            'phone'=>$this->phone ?? 'Номер телефона не указан',
            'email'=>$this->email ?? 'Адрес электронной почты не указан'
        ];
    }
}
