<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:3|max:50",
            "email" => "required|email:filter",
            "phone" => "required|numeric|digits_between:10,15",
            "subject" => "required|string|min:3|max:50",
            "message" => "required|string|min:3|max:500",
            //"terms" => "required|accepted",
            "g-recaptcha-response" => "",
        ];
    }

    public function attributes()
    {
        return [
            "name" => __("front/contact.txt3"),
            "email" => __("front/contact.txt4"),
            "phone" => __("front/contact.txt5"),
            "subject" => __("front/contact.txt6"),
            "message" => __("front/contact.txt7"),
            //"terms" => __("front/contact.txt18"),
            "g-recaptcha-response" => __("front/contact.form_recaptcha"),
        ];
    }

    public function messages()
    {
        return [
            "required" => __("front/contact.required")
        ];
    }
}
