<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableRequest extends FormRequest
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
                'table_num' => 'required|max:255',
                'branch_id' => ['required', Rule::exists('branches', 'id')],

            ];
        } else {
            return [
                'table_num' => 'sometimes|max:255',

            ];
        }

    }
}
