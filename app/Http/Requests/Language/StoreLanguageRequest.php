<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StoreLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "required",
            "code" => "required|unique:languages,code",
            "status" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            "title" => __("admin/{ModuleEnum::Language->folder()}.form_title"),
            "code" => __("admin/{ModuleEnum::Language->folder()}.form_code"),
            "status" => __("admin/general.status"),
        ];
    }
}
