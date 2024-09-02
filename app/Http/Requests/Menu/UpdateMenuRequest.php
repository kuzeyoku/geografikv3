<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title." . app()->getFallbackLocale() => "required",
            "title.*" => "",
            "url" => "nullable",
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
            "url" => __("admin/{$this->folder}.form_url"),
            "parent_id" => __("admin/{$this->folder}.form_parent"),
            "order" => __("admin/general.order"),
            "blank" => __("admin/{$this->folder}.form_blank"),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "parent_id" => $this->parent_id ?: 0,
            "order" => $this->order ?: 0,
        ]);
    }
}
