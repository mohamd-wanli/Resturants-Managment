<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('product');
        if (! $productId) {
            return [
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|int',
                'image' => 'required|image',
                'estimated_time' => 'required',
                'active' => 'sometimes|bool',
                'branch_id' => ['required', Rule::exists('branches', 'id')],
                'category_id' => ['required', Rule::exists('categories', 'id')],
            ];
        } else {
            return [
                'name' => 'required|string',
                'description' => 'sometimes|string',
                'price' => 'sometimes|int',
                'image' => 'sometimes|image',
                'estimated_time' => 'nullable',
                'active' => 'sometimes|bool',
                'category_id' => ['sometimes', Rule::exists('categories', 'id')],
            ];

        }

    }
}
