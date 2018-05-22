<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'address1' => 'required|string|max:100',
            'address2' => 'max:100',
            'country' => 'required|max:100',
            'city' => 'required|max:100',
            'postal_code' => 'required|alpha_num|max:50',
        ];
    }
}
