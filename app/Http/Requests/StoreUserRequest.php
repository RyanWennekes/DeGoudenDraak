<?php

namespace App\Http\Requests;

use App\Enums\UserRoles;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'     => 'required|max:254',
            'role'     => 'required|min:' . UserRoles::Admin . '|max:' . UserRoles::Customer . '',
            'email'    => 'required|max:254|email',
            'password' => 'required|max:80',
        ];
    }
}
