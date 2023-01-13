<?php

namespace App\Http\Requests;

use App\Rules\isValidPassword;
use App\Rules\CustomEmailValidation;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required'],
            'password' => ['required',
            Password::min(6)
                ->letters()
                ->mixedCase()
                ->numbers()],
    ];

    }
}
