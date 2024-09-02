<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class SendContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:3|max:50",
            "phone" => "required|numeric|digits_between:10,15",
            "email" => "required|email:filter",
            "subject" => "required|string|min:3|max:50",
            "message" => "required|string|min:3|max:500",
        ];
    }
}
