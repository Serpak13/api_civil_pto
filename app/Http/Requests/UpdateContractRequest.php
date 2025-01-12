<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_id'=>'nullable|exists:companies,id',
            'contract_number'=>'nullable|string',
            'contract_type'=>'nullable|string',
            'contract_date'=>'nullable|date|date_format:Y-m-d',
            'contract_status'=>'nullable|string',
            'payment_status'=>'nullable|string',
        ];
    }
}
