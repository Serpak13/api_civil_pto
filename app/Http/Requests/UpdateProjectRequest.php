<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'building_object_id' => 'nullable|exists:building_objects,id',
            'name' => 'nullable|string',
            'project_code'=>'nullable|string',
            'project_section'=> 'nullable|string',
            'project_stage'=> 'nullable|string',
        ];
    }
}
