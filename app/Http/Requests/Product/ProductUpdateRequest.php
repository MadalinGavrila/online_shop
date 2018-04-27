<?php

namespace App\Http\Requests\Product;

use App\Rules\ValidPrice;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'brand' => 'required',
            'price' => [
                'required',
                'max:8',
                new ValidPrice()
            ],
            'stock' => 'required|integer|digits_between:1,6',
            'description' => 'required'
        ];
    }
}
