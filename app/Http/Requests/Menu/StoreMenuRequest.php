<?php

namespace App\Http\Requests\Menu;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Menu->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "url" => "nullable",
            "urlSelect" => "nullable",
            "parent_id" => "numeric|min:0",
            "order" => "required|numeric|min:0",
            "blank" => "nullable|boolean",
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form_title"),
            "title.*" => __("admin/{$this->folder}.form_title"),
            "parent_id" => __("admin/{$this->folder}.form_parent"),
            "order" => __("admin/general.order"),
            "blank" => __("admin/{$this->folder}.form_blank"),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "url" => $this->urlSelect ?: $this->url,
            "parent_id" => $this->parent_id ?: 0,
            "order" => $this->order ?: 0,
        ]);
    }
}
