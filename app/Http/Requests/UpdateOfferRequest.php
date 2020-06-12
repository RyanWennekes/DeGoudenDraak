<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'product_id' => 'required|exists:App\Product,id',
            'discount'   => 'required|min:1,max:100',
            'date_start' => 'required|date_format:Y-m-d H:i:s',
            'date_end'   => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
