<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
            'description' => 'required|max:50',
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'exchange_option' => 'required|max:50',
            'images' => 'required',
        ];
    }
}
