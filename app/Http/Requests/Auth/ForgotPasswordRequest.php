<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email:filter|exists:users',
            'g-recaptcha-response' => ""
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('admin/auth.email'),
        ];
    }
}
