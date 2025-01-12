<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest
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
            'contract_number'=>'string|required',
            'contract_type'=>'string|required',
            'contract_date'=>'required|date|date_format:Y-m-d',
            'contract_status'=>'string|required',
            'payment_status'=>'string|required',

        ];
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ApiException(
            "Не указаны обязательные параметры",
            $validator->errors()->toArray(),
        );
    }
}
