<?php

namespace App\Http\Requests\Popup;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePopupRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::Popup->folder();
    }

    public function rules(): array
    {
        return [
            "type" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif",
            "url" => "nullable|active_url",
            "video" => "nullable|active_url",
            "title.*" => "nullable",
            "description.*" => "nullable",
            "status" => "required",
            "imageDelete" => "",
            "time" => "numeric|nullable",
            "width" => "numeric|nullable",
            "closeOnEscape" => "required",
            "closeButton" => "required",
            "overlayClose" => "required",
            "pauseOnHover" => "required",
            "fullScreenButton" => "required",
            "color" => "nullable",
        ];
    }

    public function attributes(): array
    {
        return [
            "type" => __("admin/{$this->folder}.form_type"),
            "image" => __("admin/{$this->folder}.form_image"),
            "url" => __("admin/{$this->folder}.form_url"),
            "video" => __("admin/{$this->folder}.form_video"),
            "title.*" => __("admin/{$this->folder}.form_title"),
            "description.*" => __("admin/{$this->folder}.form_description"),
            "status" => __("admin.general.status"),
            "time" => __("admin/{$this->folder}.form_time"),
            "width" => __("admin/{$this->folder}.form_width"),
            "closeOnEscape" => __("admin/{$this->folder}.form_closeOnEscape"),
            "closeButton" => __("admin/{$this->folder}.form_closeButton"),
            "overlayClose" => __("admin/{$this->folder}.form_overlayClose"),
            "pauseOnHover" => __("admin/{$this->folder}.form_pauseOnHover"),
            "fullScreenButton" => __("admin/{$this->folder}.form_fullScreenButton"),
            "color" => __("admin/{$this->folder}.form_color"),
        ];
    }
}
