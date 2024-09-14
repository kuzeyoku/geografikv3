<?php

namespace App\Services\Front;

use App\Enums\StatusEnum;
use App\Models\BlockedUser;
use App\Models\Message;
use App\Services\ValidationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactService
{

    /**
     * @throws Exception
     */
    public static function sendMail(Request $request): void
    {
        ValidationService::checkRecaptcha($request);
        self::checkBlocked($request);
        self::createMessage($request);
        self::setEmailSettings();
        Mail::to(setting("contact", "email"))
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
            'mail.mailers.smtp.host' => setting("smtp", "host"),
            'mail.mailers.smtp.port' => setting("smtp", "port"),
            'mail.mailers.smtp.encryption' => setting("smtp", "encryption"),
            'mail.mailers.smtp.username' => setting("smtp", "username"),
            'mail.mailers.smtp.password' => setting("smtp", "password"),
            "mail.from.address" => setting("smtp", "from_address"),
            "mail.from.name" => setting("smtp", "from_name"),
        ]);
    }
}
