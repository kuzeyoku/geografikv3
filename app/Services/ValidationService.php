<?php

namespace App\Services;

use App\Services\Front\SettingService;
use Exception;

class ValidationService
{
    /**
     * @throws Exception
     */
    public static function checkRecaptcha($request): bool
    {
        if (SettingService::recaptchaIsActive()) {
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . setting("integration", "recaptcha_secret_key") . '&response=' . $request->{'g-recaptcha-response'});
            if (($recaptcha = json_decode($response)) && $recaptcha->success && $recaptcha->score < 0.5) {
                return true;
            }
            throw new Exception(__("recaptcha.failed"));
        }
        return true;
    }
}
