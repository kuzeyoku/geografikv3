<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class UpdateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "required",
            "status" => "required"
        ];
    }

    public function attributes(): array
    {
        return [
            "title" => __("admin/{ModuleEnum::Language->folder()}.form_title"),
            "status" => __("admin/general.status")
        ];
    }
}
