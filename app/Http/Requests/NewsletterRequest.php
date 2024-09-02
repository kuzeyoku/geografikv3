<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
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
            "n_email" => "required|email|unique:newsletters,email",
            "g-recapcha-response" => ""
        ];
    }

    public function attributes(): array
    {
        return [
            "n_email" => __("front/footer.txt4"),
            "g-recapcha-response" => __("front/contact.form_recaptcha")
        ];
    }
}
