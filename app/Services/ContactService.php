<?php

namespace App\Services;

use App\Models\Message;
use App\Enums\StatusEnum;
use App\Models\BlockedUser;
use Illuminate\Support\Facades\Mail;

class ContactService
{

    public static function sendMail($request)
    {
        self::checkRecaptcha($request);
        self::checkBlocked($request);
        self::createMessage($request);
        self::setEmailSettings();
        Mail::to(config("contact.email"))
            ->send(new \App\Mail\Contact($request));
    }

    private static function checkRecaptcha($request)
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

    private static function checkBlocked($request)
    {
        $blockedUser = BlockedUser::where("email", $request->email)
            ->orWhere("ip", $request->ip())
            ->exists();
        if ($blockedUser) {
            throw new \Exception(__("front/contact.blocked"));
        }
    }

    private static function createMessage($request)
    {
        Message::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
            "status" => StatusEnum::Unread->value,
            "ip" => $request->ip(),
            "user_agent" => $request->userAgent(),
            //"consent" => $request->terms
        ]);
    }

    private static function setEmailSettings()
    {
        config([
            'mail.mailers.smtp.host' => config("smtp.host"),
            'mail.mailers.smtp.port' => config("smtp.port"),
            'mail.mailers.smtp.encryption' => config("smtp.encryption"),
            'mail.mailers.smtp.username' => config("smtp.username"),
            'mail.mailers.smtp.password' => config("smtp.password"),
            "mail.from.address" => config("smtp.from_address"),
            "mail.from.name" => config("smtp.from_name"),
        ]);
    }
}
