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
            'product_name' => 'required | max:20',
            'price' => 'required | max:20',
            'stock' => 'required | max:20',
            'company_id' => 'required',
            'comment' => 'nullable',
            'img_path' => 'nullable',
        ];
    }
}
