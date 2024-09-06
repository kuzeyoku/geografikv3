<?php

namespace App\Services;

use App\Enums\StatusEnum;

class RecaptchaService
{
    /**
     * @throws \Exception
     */
    public static function check(array $request): bool
    {
        if (config("integration.recaptcha_status") === StatusEnum::Active->value) {
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . config("integration.recaptcha_secret_key") . '&response=' . $request["g-recaptcha-response"]);
            if (($recaptcha = json_decode($response)) && $recaptcha->success && $recaptcha->score >= 0.5) {
                return true;
            }
            throw new \Exception(__("front/contact.recaptcha_failed"));
        }

        return true;
    }
}
