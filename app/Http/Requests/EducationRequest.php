<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            "surname" => "required|string|min:3|max:50",
            "phone" => "required|numeric|digits_between:10,15",
            "email" => "required|email:filter",
            "type" => "required|numeric|between:0,2",
            "g-recaptcha-response" => "",
        ];
    }

    public function attributes()
    {
        return [
            "name" => __("front/education.name"),
            "surname" => __("front/education.surname"),
            "phone" => __("front/education.phone"),
            "email" => __("front/education.email"),
            "type" => __("front/education.education_type"),
        ];
    }
}
