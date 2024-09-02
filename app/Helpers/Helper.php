<?php

use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Cache;

function languageList()
{
    return Cache::remember('languageList', 3600, function () {
        return \App\Services\Admin\LanguageService::toArray();
    });
}

function statusList()
{
    return Cache::remember('statusList', 3600, function () {
        return StatusEnum::toSelectArray();
    });
}

function formInfo($text)
{
    echo '<span data-toggle="tooltip" data-placement="right" title="' . $text . '">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <g>
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355z"></path>
            </g>
        </svg>
    </span>';
}

function recaptcha()
{
    if (config("integration.recaptcha_status") === StatusEnum::Active->value) {
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . config("integration.recaptcha_secret_key") . '&response=' . request("g-recaptcha-response"));

        if (($recaptcha = json_decode($response)) && $recaptcha->success && $recaptcha->score >= 0.5) {
            return true;
        }

        return false;
    }

    return true;
}

function themeView($folder, $file)
{
    return config("template.{$folder}.view") . "." . $file;
}

function themeAsset($folder, $file)
{
    return asset("assets/" . config("template.{$folder}.asset") . "/" . $file);
}
