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

    /**
     * @throws Exception
     */
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
            default => throw new \Exception('Unexpected match value'),
        };
    }

    /**
     * @throws Exception
     */
    public function icon(): string
    {
        return match ($this) {
            self::Active => "check",
            self::Passive => "ban",
            self::Draft => "edit",
            self::Pending => "clock",
            default => throw new \Exception('Unexpected match value'),
        };
    }

    /**
     * @throws Exception
     */
    public function badge(): string
    {
        return sprintf('<span class="badge badge-%s">%s</span>', $this->color(), $this->title());
    }

    public static function getValues(): array
    {
        return [
            StatusEnum::Active->value,
            StatusEnum::Passive->value,
            StatusEnum::Draft->value,
            StatusEnum::Pending->value,
        ];
    }

    /**
     * @throws Exception
     */
    public static function fromValue($value): StatusEnum
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

    public static function toSelectArray(): array
    {
        return [
            StatusEnum::Active->value => StatusEnum::Active->title(),
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Draft->value => StatusEnum::Draft->title(),
            StatusEnum::Pending->value => StatusEnum::Pending->title(),
        ];
    }

    public static function getOnOffSelectArray(): array
    {
        return [
            StatusEnum::Passive->value => StatusEnum::Passive->title(),
            StatusEnum::Active->value => StatusEnum::Active->title(),
        ];
    }

    public static function getTrueFalseSelectArray(): array
    {
        return [
            false => StatusEnum::No->title(),
            true => StatusEnum::Yes->title(),
        ];
    }

    public static function getYesNoSelectArray(): array
    {
        return [
            StatusEnum::No->value => StatusEnum::No->title(),
            StatusEnum::Yes->value => StatusEnum::Yes->title(),
        ];
    }
}
