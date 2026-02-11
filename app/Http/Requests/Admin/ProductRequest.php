<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug',
                'status' => 'integer',
                'sku' => 'required|string|max:255|unique:products,sku',
                'sale_price' => 'required|numeric|max:99999',
                'previous_price' => 'nullable|numeric|max:99999',
                'purchase_price' => 'nullable|numeric|max:99999',
                'barcode' => 'required|string|max:255',
                'product_variation_type' => 'nullable',
                'status' => 'nullable',
                'stock' => 'required|integer|max:99999',
                'tags' => 'string|nullable',
                'label' => 'string|nullable',
                'short_description' => 'nullable',
                'long_description' => 'nullable',
                'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
                'brand_id' => 'nullable|integer',
                'attribute_id' => 'nullable|integer',
        ];
    }
}
