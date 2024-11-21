<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required',
            'string',
            'max:255',
            $this->isMethod('post') ? 'unique:coupons,code' : 'unique:coupons,code,' . $this->route('coupon'),
            ],
            
            'type' => ['required', 'in:fixed,percentage'],
            'limit_type' => ['required', 'in:usage,time'],

            // Conditional required fields based on the type and limit_type
            'discount_amount' => [
                'nullable',
                'numeric',
                'min:0',
                'required_if:type,fixed',
            ],
            'discount_percentage' => [
                'nullable',
                'numeric',
                'min:1',
                'max:100',
                'required_if:type,percentage',
            ],
            'max_usage' => [
                'nullable',
                'integer',
                'min:1',
                'required_if:limit_type,usage',
            ],
            'expires_at' => [
                'nullable',
                'date',
                'after_or_equal:today',
                'required_if:limit_type,time',
            ],
            'usage_count' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'The coupon code is required.',
            'code.unique' => 'The coupon code must be unique.',
            'type.required' => 'The coupon type is required.',
            'limit_type.required' => 'The limit type is required.',
            'discount_amount.required_if' => 'The discount amount is required when the type is fixed.',
            'discount_percentage.required_if' => 'The discount percentage is required when the type is percentage.',
            'max_usage.required_if' => 'The max usage is required when the limit type is usage.',
            'expires_at.required_if' => 'The expiration date is required when the limit type is time.',
            'discount_amount.numeric' => 'The discount amount must be a valid number.',
            'discount_percentage.numeric' => 'The discount percentage must be a valid number.',
            'discount_percentage.min' => 'The discount percentage must be at least 1.',
            'discount_percentage.max' => 'The discount percentage cannot exceed 100.',
            'max_usage.integer' => 'The max usage must be a valid number.',
            'expires_at.date' => 'The expiration date must be a valid date.',
            'expires_at.after_or_equal' => 'The expiration date must be today or in the future.',
        ];
    }

    /**
     * Get the attributes for validation errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code' => 'coupon code',
            'type' => 'coupon type',
            'limit_type' => 'limit type',
            'discount_amount' => 'discount amount',
            'discount_percentage' => 'discount percentage',
            'max_usage' => 'maximum usage',
            'expires_at' => 'expiration date',
            'is_active' => 'active status',
        ];
    }
}
