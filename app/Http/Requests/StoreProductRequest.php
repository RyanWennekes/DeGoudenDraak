<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_type_id' => 'required|exists:App\ProductType,id',
            'code'            => 'required|max:45|unique:products',
            'name'            => 'required|max:100|unique:products',
            'price'           => 'required|min:0.01',
            'spiciness'       => 'max:3',
            'description_nl'  => 'max:16777214',
            'description_en'  => 'max:16777214',
            'minimum_amount'  => '',
        ];
    }
}
