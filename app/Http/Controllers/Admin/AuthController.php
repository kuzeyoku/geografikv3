<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\RecaptchaService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class AuthController extends Controller
{
    protected string $route;
    protected string $folder;

    public function __construct()
    {
        $this->route = "auth";
        $this->folder = "auth";
        View::share([
            "route" => $this->route,
            "folder" => $this->folder
        ]);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view(themeView("admin", "{$this->folder}.login"));
    }

    public function authenticate(LoginRequest $request)
    {
        RecaptchaService::check($request->validated());
        if (Auth::attempt($request->only("email", "password"))) {
            $request->session()->regenerate();
            $user = User::where("email", $request->email)->first();
            $user->notify(new AdminNotification("success", $user->name . " Tarafından Giriş Yapıldı", "IP : " . $request->ip()));
            $message = [
                "title" => __("admin/{$this->folder}.login_success_title", ["name" => Auth::user()->name]),
                "message" => __("admin/{$this->folder}.login_success_message")
            ];
            return redirect()
                ->intended('admin')
                ->withSuccess($message);
        }
        $user = User::where("role", "admin")->get();
        $user->each(function ($item) use ($request) {
            $item->notify(new AdminNotification("danger", "Başarısız Giriş Denemesi", "IP: " . $request->ip() . " - Email: " . $request->email, ""));
        });
        return back()
            ->withInput()
            ->withError(__("admin/{$this->folder}.login_error"));
    }

    public function forgot_password_view()
    {
        return view(themeView("admin", "{$this->folder}.forgot_password"));
    }

    public function forgot_password(ForgotPasswordRequest $request)
    {
        RecaptchaService::check($request->validated());
        $status = Password::sendResetLink($request->only("email"));
        return $status === Password::RESET_LINK_SENT ? redirect()->route("admin.auth.login")->withSuccess(__($status)) : back()->withInput()->withError(__($status));
    }

    public function reset_password_view(Request $request)
    {
        $token = $request->route("token");
        return view(themeView("admin", "{$this->folder}.reset_password"), compact("token"));
    }

    public function reset_password(Request $request)
    {
        $tokenData = DB::table("password_reset_tokens")->get();
        $email = null;
        foreach ($tokenData as $token) {
            if (Hash::check($request->token, $token->token)) {
                $email = $token->email;
                break;
            }
        }

        $status = Password::reset(
            array_merge($request->only("email", "password", "password_confirmation", "token"), ["email" => $email]),
            function (User $user, string $password) {
                $user->forceFill([
                    "password" => Hash::make($password)
                ])->save();
                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("admin.{$this->route}.login")->withSuccess(__($status))
            : back()->withInput()->withError(__($status));
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()
            ->route("admin.{$this->route}.login")
            ->with("success", __("admin/{$this->folder}.logout_success"));
    }
}
