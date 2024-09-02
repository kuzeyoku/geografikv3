<?php

namespace App\Services\Admin;

use App\Models\Message;
use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use App\Mail\Admin\ReplyMessage;
use App\Models\BlockedUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class MessageService extends BaseService
{
    public function __construct(Message $message)
    {
        parent::__construct($message, ModuleEnum::Message);
    }

    public function messageRead(Model $message)
    {
        $message->status = StatusEnum::Read->value;
        $message->save();
    }

    public function sendReply($request, Model $message)
    {
        Mail::to($message->email)->send(new ReplyMessage($request, $message));
        $message->status = StatusEnum::Answered->value;
        $message->save();
    }

    public function block(Model $message)
    {
        if (BlockedUser::where('email', $message->email)->whereOr("ip", $message->ip)->exists()) {
            throw new \Exception(__("admin/" . parent::folder() . ".already_blocked"));
        }
        BlockedUser::create([
            'email' => $message->email,
            'ip' => $message->ip
        ]);
        $message->delete();
        Message::where('email', $message->email)->orWhere('ip', $message->ip)->delete();
    }

    public function unblock(int $user_id)
    {
        BlockedUser::findOrFail($user_id)->delete();
    }

    public function getBlocked()
    {
        return BlockedUser::paginate(config("pagination.admin", 15));
    }
}
