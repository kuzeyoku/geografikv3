<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Product->folder();
    }

    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "nullable",
            "description.*" => "nullable",
            "features.*" => "nullable",
            "price" => "nullable",
            "currency" => "nullable",
            "order" => "required|numeric|min:0",
            "status" => "required",
            "category_id" => "nullable",
            "image" => "image|mimes:png,jpeg,jpg,gif",
            "document" => "file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx",
            "video" => "nullable|active_url"
        ];
    }

    public function attributes(): array
    {
        return [
            "title." . app()->getFallbackLocale() => __("admin/{$this->folder}.form_title"),
            "title.*" => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "features.*" => __("admin/{$this->folder}.form_features"),
            "price" => __("admin/{$this->folder}.form_price"),
            "currency" => __("admin/{$this->folder}.form_currency"),
            "order" => __("admin/general.order"),
            "status" => __("admin/general.status"),
            "category_id" => __("admin/{$this->folder}.form_category"),
            "image" => __("admin/{$this->folder}.form_image"),
            "video" => __("admin/{$this->folder}.form_video")
        ];
    }
}
