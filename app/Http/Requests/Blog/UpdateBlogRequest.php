<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Blog->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "description.*" => "",
            "tags.*" => "",
            "order" => "required|numeric|min:0",
            "status" => "required",
            "category_id" => "",
            "image" => "image|mimes:jpeg,png,jpg,gif",
            "imageDelete" => ""
        ];
    }

    public function attributes(): array
    {
        return [
            "title.*" => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "tags.*" => __("admin/{$this->folder}.form_tags"),
            "category_id" => __("admin/{$this->folder}.form_category"),
            "image" => __("admin/{$this->folder}.form_image"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status")
        ];
    }
}
