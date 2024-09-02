<?php

namespace App\Http\Requests\User;

use App\Enums\ModuleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected $folder;

    public function __construct()
    {
        $this->folder = ModuleEnum::User->folder();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email," . $this->user->id . ",id",
            "password" => "nullable|min:6",
            "role" => "required",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => __("admin/{$this->folder}.form_name"),
            "email" => __("admin/{$this->folder}.form_email"),
            "password" => __("admin/{$this->folder}.form_password"),
            "role" => __("admin/{$this->folder}.form_role"),
        ];
    }
}
