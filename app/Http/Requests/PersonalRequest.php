<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
            'age' => 'required|integer|min:0|max:150',
            'weight' => 'required|numeric|between:0.00,999.99',
            'height' => 'required|numeric|between:0.00,9.99',
            'health_goals' => 'required|string|max:500',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
