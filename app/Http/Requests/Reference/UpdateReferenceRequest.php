<?php

namespace App\Http\Requests\Reference;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class UpdateReferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Reference->folder();
    }

    public function rules(): array
    {
        return [
            "image" => "image|mimes:jpeg,png,jpg,gif",
            "title" => "required",
            "url" => "nullable|active_url",
            "order" => "required|numeric|min:0",
            "status" => "required",
            "imageDelete" => ""
        ];
    }

    public function attributes(): array
    {
        return [
            "image" => __("admin/{$this->folder}.form_image"),
            "title" => __("admin/{$this->folder}.form_title"),
            "url" => __("admin/{$this->folder}.form_url"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status")
        ];
    }
}
