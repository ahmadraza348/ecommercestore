<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
           'billing.first_name' => 'required|string|max:255',
            'billing.last_name' => 'required|string|max:255',
            'billing.email' => 'required|email|max:255',
            'billing.country' => 'required|string|max:255',
            'billing.address_1' => 'required|string|max:500',
            'billing.city' => 'required|string|max:255',
            'billing.postcode' => 'required|string|max:20',
            'billing.phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,stripe',

            // Shipping validation if different shipping is selected
            'different_shipping' => 'sometimes|boolean',
            'shipping.first_name' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.last_name' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.email' => 'required_if:different_shipping,1|nullable|email|max:255',
            'shipping.country' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.address_1' => 'required_if:different_shipping,1|nullable|string|max:500',
            'shipping.city' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.postcode' => 'required_if:different_shipping,1|nullable|string|max:20',
            'shipping.phone' => 'required_if:different_shipping,1|nullable|string|max:20',
        ];
    }
}
