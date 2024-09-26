<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StoreSectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    private string $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Sector->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "url" => "required",
            "status" => "required",
            "order" => "required|numeric|min:0",
            "image" => "image|mimes:jpeg,png,jpg,gif",
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form_title"),
            "url" => __("admin/{$this->folder}.form_url"),
            "status" => __("admin/general.status"),
            "order" => __("admin/general.order"),
            "image" => __("admin/{$this->folder}.form_image"),
        ];
    }
}
