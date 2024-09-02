<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Page->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "description.*" => "",
            "status" => "required",
            "quick_link" => "required"
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "status" => __("admin/general.status"),
            "quick_link" => __("admin/{$this->folder}.form_quick_link")
        ];
    }
}
