<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCartRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'pro_qty' => 'required|integer|min:1',
            'color' => 'nullable|exists:colors,id',
            'attribute_value_id' => 'nullable|exists:attribute_values,id',
             'final_price' => 'numeric|min:0',
        ];
    }
}
