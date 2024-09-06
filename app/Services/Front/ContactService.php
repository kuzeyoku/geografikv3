<?php

namespace App\Services\Front;

use App\Enums\StatusEnum;
use App\Models\BlockedUser;
use App\Models\Message;
use App\Services\RecaptchaService;
use Exception;
use Illuminate\Support\Facades\Mail;

class ContactService
{

    /**
     * @throws \Exception
     */
    public static function sendMail($request): void
    {
        RecaptchaService::check($request);
        self::checkBlocked($request);
        self::createMessage($request);
        self::setEmailSettings();
        Mail::to(config("contact.email"))
            ->send(new \App\Mail\Contact($request));
    }

    /**
     * @throws Exception
     */
    private static function checkBlocked($request): void
    {
        $blockedUser = BlockedUser::where("email", $request->email)
            ->orWhere("ip", $request->ip())
            ->exists();
        if ($blockedUser) {
            throw new Exception(__("front/contact.blocked"));
        }
    }

    private static function createMessage($request): void
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

    private static function setEmailSettings(): void
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
