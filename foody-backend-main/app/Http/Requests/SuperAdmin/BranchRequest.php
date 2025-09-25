<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'POST') {
            return [
                'restaurant_id' => 'required|exists:restaurants,id',
                'name' => 'required|string',
                'description' => 'nullable|string',

            ];
        } else {
            return [
                'name' => 'nullable|string',
                'description' => 'nullable|string',

            ];
        }
    }
}
