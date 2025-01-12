<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company'=>$this->company?->name,
            'contract_number'=>$this->contract_number,
            'contract_type'=>$this->contract_type,
            'contract_date'=>$this->contract_date,
            'contract_status'=>$this->contract_status,
            'payment_status'=>$this->payment_status
        ];
    }
}
