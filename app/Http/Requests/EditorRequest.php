<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "file" => "image|mimes:jpeg,png,jpg,gif|max:10240",
        ];
    }
}
