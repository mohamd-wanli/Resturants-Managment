<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'table_id'=>['required',Rule::exists('tables','id')],
            'waiter_id'=>['required',Rule::exists('users','waiter_id')],
            'chef_id'=>['required',Rule::exists('users','chef_id')],
            'total_price'=>'required',
            'time_Waiter'
            'estimated_time'
            'status'
        ];
    }
}
