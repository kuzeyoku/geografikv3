<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ModuleEnum;

class UpdateSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Slider->folder();
    }

    public function rules(): array
    {
        return [
            "title.*" => "",
            "description.*" => "",
            "order" => "required|numeric|min:0",
            "status" => "",
            "image" => "image|mimes:jpeg,png,jpg,gif",
            "button" => "",
            "video" => "",
            "imageDelete" => "",
        ];
    }

    public function attributes(): array
    {
        return [
            "title.*" => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "image" => __("admin/{$this->folder}.form_image"),
            "button" => __("admin/{$this->folder}.form_button"),
            "video" => __("admin/{$this->folder}.form_video"),
            "status" => __("admin/general.status"),
            "order" => __("admin/general.order"),
        ];
    }
}
