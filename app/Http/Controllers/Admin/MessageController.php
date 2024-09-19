<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Message;
use Illuminate\Support\Facades\View;
use App\Services\Admin\MessageService;
use App\Http\Requests\Message\ReplyMessageRequest;

class MessageController extends Controller
{

    public function __construct(private readonly MessageService $service)
    {
        View::share([
            "route" => $service->route(),
            "folder" => $service->folder()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact("items"));
    }

    public function show(Message $message)
    {
        $this->service->messageRead($message);
        return view(themeView("admin", "{$this->service->folder()}.show"), compact("message"));
    }

    public function reply(Message $message)
    {
        return view(themeView("admin", "{$this->service->folder()}.reply"), compact("message"));
    }

    public function sendReply(ReplyMessageRequest $request, Message $message)
    {
        try {
            $this->service->sendReply($request, $message);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(Message $message)
    {
        try {
            $this->service->delete($message);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function block(Message $message)
    {
        try {
            $this->service->block($message);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",$e->getMessage());
        }
    }

    public function blocked()
    {
        $items = $this->service->getBlocked();
        return view(themeView("admin", "{$this->service->folder()}.blocked"), compact("items"));
    }

    public function unblock(int $user_id)
    {
        try {
            $this->service->unblock($user_id);
            return redirect()
                ->route("admin.{$this->service->route()}.blocked")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }
}
