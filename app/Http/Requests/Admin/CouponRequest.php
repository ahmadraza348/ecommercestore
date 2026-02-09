<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
        $coupon = $this->route('coupons')?->id;
        return [
             'label' => 'required|string',
            'discount_type' => 'required',
            'amount' => 'required|numeric',
            'code' => ['required', 'string', Rule::unique('coupons', 'code')->ignore($coupon)],
            'starting_from' => 'required|date',
            'ending_at' => 'required|date',
            'status' => 'required|string',
        ];
    }
}
