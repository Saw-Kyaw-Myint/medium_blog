<?php

namespace App\Http\Requests;

use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            'name'=>'required|unique:users,name,'.Auth::user()->id,
            'email'=>['required','unique:users,email,'.Auth::user()->id,new CustomEmailValidation()],
            'bio'=>'required',
        ];
    }
}
