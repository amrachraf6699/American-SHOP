<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can modify this if you have specific authorization logic
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
            'name' => 'required|string|max:255',
            'home_slider' => 'required|boolean',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount' => 'nullable|numeric|lt:price',
            'send_to_newsletter' => 'required|boolean',
        ];
    }

    /**
     * Get the custom error messages for validation failures.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',
            'name.max' => 'The product name cannot exceed 255 characters.',
            'start_price.required' => 'The price is required.',
            'start_price.numeric' => 'The price must be a numeric value.',
            'start_price.min' => 'The price must be at least 0.',
            'categories.required' => 'At least one category is required.',
            'categories.array' => 'Categories must be an array.',
            'categories.*.exists' => 'The selected category does not exist.',
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each file must be a valid image.',
            'images.*.mimes' => 'Only jpeg, png, jpg, gif, and svg images are allowed.',
            'images.*.max' => 'Each image must be smaller than 2MB.',
            'discount.numeric' => 'The discount must be a numeric value.',
            'discount.less_than' => 'The discount must be less than the price.',
        ];
    }

    /**
     * Get the custom attributes for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'name' => 'product name',
            'description' => 'product description',
            'start_price' => 'starting price',
            'categories' => 'categories',
            'images' => 'product images',
        ];
    }
}
