<?php

namespace App\Http\Requests\Testimonial;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected string $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Testimonial->folder();
    }

    public function rules(): array
    {
        return [
            "image" => "image|mimes:jpeg,png,jpg,gif",
            "name" => "required",
            "company" => "nullable",
            "position" => "nullable",
            "message" => "required",
            "order" => "required|numeric|min:0",
            "status" => "required",
            "imageDelete" => "",
        ];
    }

    public function attributes(): array
    {
        return [
            "image" => __("admin/{$this->folder}.form_image"),
            "name" => __("admin/{$this->folder}.form_name"),
            "company" => __("admin/{$this->folder}.form_company"),
            "position" => __("admin/{$this->folder}.form_position"),
            "message" => __("admin/{$this->folder}.form_message"),
            "order" => __("admin/general.order"),
            "status" => __("admin.general.status"),
        ];
    }
}
