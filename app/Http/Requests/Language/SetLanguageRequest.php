<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class SetLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "locale" => "required|string|exists:languages,code",
        ];
    }
}
