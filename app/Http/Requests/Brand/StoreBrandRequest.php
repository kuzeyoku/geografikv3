<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Brand->folder();
    }

    public function rules(): array
    {
        return [
            "image" => "required|image|mimes:jpeg,png,jpg,gif",
            "url" => "nullable|active_url",
            "title" => "nullable",
            "order" => "required|numeric|min:0",
            "status" => "required"
        ];
    }

    public function attributes(): array
    {
        return [
            "image" => __("admin/{$this->folder}.form_image"),
            "url" => __("admin/{$this->folder}.form_url"),
            "title" => __("admin/{$this->folder}.form_title"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status")
        ];
    }
}
