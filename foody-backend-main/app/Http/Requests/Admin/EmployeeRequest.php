<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required|email',
                'user_type' => 'required',
                'branch_id' => ['required', Rule::exists('branches', 'id')],
            ];
        } else {
            return [
                'name' => 'sometimes',
                'email' => 'sometimes|email',
                'user_type' => 'sometimes',
            ];

        }

    }
}
