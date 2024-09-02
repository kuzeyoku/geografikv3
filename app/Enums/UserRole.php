<?php

namespace App\Enums;

enum UserRole: string
{
    case DEMO  = "demo";
    case EDITOR = "editor";
    case ADMIN = "admin";

    public function permissions()
    {
        return match ($this) {
            self::DEMO => [
                "index",
                "create"
            ],
            self::EDITOR => [
                "index",
                "create",
                "edit",
                "update"
            ]
        };
    }

    public static function getPermissions($role)
    {
        return UserRole::from($role->value)->permissions();
    }


    public function title(): string
    {
        return __("admin/role." . $this->value);
    }

    public static function getValues(): array
    {
        return [
            self::DEMO->value,
            self::EDITOR->value,
            self::ADMIN->value,
        ];
    }

    public function in(string $role): bool
    {
        return $this->value === $role;
    }

    public static function getSelectArray(): array
    {
        return [
            self::DEMO->value => self::DEMO->title(),
            self::EDITOR->value => self::EDITOR->title(),
            self::ADMIN->value => self::ADMIN->title(),
        ];
    }
}
