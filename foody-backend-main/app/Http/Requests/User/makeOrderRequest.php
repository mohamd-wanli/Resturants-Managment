<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class makeOrderRequest extends FormRequest
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
        return [
            'table_id' => ['required', Rule::exists('tables', 'id')],
            'branch_id' => ['required', Rule::exists('branches', 'id')],
            'restaurant_id' => ['required', Rule::exists('restaurants', 'id')],
            'meals' => 'required|array',
            'meals.*.meal_id' => ['required', Rule::exists('products', 'id')],
            'meals.*.qty' => 'nullable|integer',
            'meals.*.note' => 'nullable|string',

        ];
    }
}
