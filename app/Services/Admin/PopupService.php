<?php

namespace App\Services\Admin;

use App\Models\Popup;
use App\Enums\ModuleEnum;
use Illuminate\Database\Eloquent\Model;

class PopupService extends BaseService
{

    public function __construct(Popup $popup)
    {
        parent::__construct($popup, ModuleEnum::Popup);
    }

    public function create($request): void
    {
        $request["setting"] = $this->setToSetting($request);
        parent::create($request);
    }

    public function update($request, Model $item): void
    {
        $request ["setting"] = $this->setToSetting($request);
        parent::update($request, $item);
    }

    private function setToSetting($request): string
    {
        return json_encode([
            "time" => $request["time"] ?? 0,
            "width" => $request["width"] ?? 600,
            "closeOnEscape" => $request["closeOnEscape"],
            "closeButton" => $request["closeButton"],
            "overlayClose" => $request["overlayClose"],
            "pauseOnHover" => $request["pauseOnHover"],
            "fullScreenButton" => $request["fullScreenButton"],
            "color" => $request["color"] ?? "#88A0B9",
        ]);
    }
}
