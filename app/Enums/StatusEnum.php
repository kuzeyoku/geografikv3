<?php

namespace App\Enums;

use Exception;

enum StatusEnum: string
{
    case Active = "active";
    case Passive = "passive";
    case Draft = "draft";
    case Pending = "pending";
    case Read = "read";
    case Unread = "unread";
    case Answered = "answered";
    case Yes = "yes";
    case No = "no";

    public function title(): string
    {
        return __("admin/status." . $this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => "success",
            self::Passive => "danger",
            self::Draft => "warning",
            self::Pending => "secondary",
            self::Read => "linesuccess",
            self::Unread => "linedanger",
            self::Answered => "lineinfo",
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Active => "check",
            self::Passive => "ban",
            self::Draft => "edit",
            self::Pending => "clock",
        };
    }

    public function badge(): string
    {
        return sprintf('<span class="badge badge-%s">%s</span>', $this->color(), $this->title());
    }

    public static function getValues()
    {
        return [
            StatusEnum::Active->value,
            StatusEnum::Passive->value,
            StatusEnum::Draft->value,
            StatusEnum::Pending->value,
        ];
    }

    public static function fromValue($value)
    {
        $statusList = [
            'active' => StatusEnum::Active,
            'passive' => StatusEnum::Passive,
            'draft' => StatusEnum::Draft,
            'pending' => StatusEnum::Pending,
            'read' => StatusEnum::Read,
            'unread' => StatusEnum::Unread,
            'answered' => StatusEnum::Answered,
        ];

        if (array_key_exists($value, $statusList)) {
            return $statusList[$value];
        }

        throw new Exception(__("admin/general.invalid_value"));
    }

    public static function toSelectArray()
    {
        return [
            StatusEnum::Active->value => StatusEnum::Active->title(),
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Draft->value => StatusEnum::Draft->title(),
            StatusEnum::Pending->value => StatusEnum::Pending->title(),
        ];
    }

    public static function getMessageStatusSelectArray()
    {
        return [
            StatusEnum::Read->value => StatusEnum::Read->title(),
            StatusEnum::Unread->value => StatusEnum::Unread->title(),
            StatusEnum::Answered->value => StatusEnum::Answered->title(),
        ];
    }

    public static function getOnOffSelectArray()
    {
        return [
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Active->value => StatusEnum::Active->title(),
        ];
    }

    public static function getTrueFalseSelectArray()
    {
        return [
            false => StatusEnum::No->title(),
            true => StatusEnum::Yes->title(),
        ];
    }

    public static function getYesNoSelectArray()
    {
        return [
            StatusEnum::No->value => StatusEnum::No->title(),
            StatusEnum::Yes->value => StatusEnum::Yes->title(),
        ];
    }
}
