<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Throwable;
use App\Models\User;
use App\Enums\UserRole;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{

    public function __construct(private readonly UserService $service)
    {
        View::share([
            "route" => $service->route(),
            "folder" => $service->folder(),
            "roles" => UserRole::getSelectArray(),
        ]);
    }

    public function index()
    {
        $items = $this->service->getAll();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact('items'));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function edit(User $user)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $this->service->update($request->validated(), $user);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(User $user)
    {
        if (User::count() == 1) {
            return back()
                ->with("error",__("admin/{$this->service->folder()}.delete_error_last"));
        } else if ($user->id == Auth::user()->id) {
            return back()
                ->with("error",__("admin/{$this->service->folder()}.delete_error_self"));
        } else if (User::where("role", UserRole::ADMIN)->count() == 1) {
            return back()
                ->with("error",__("admin/{$this->service->folder()}.delete_error_last_admin"));
        } else {
            try {
                $this->service->delete($user);
                return redirect()
                    ->route("admin.{$this->service->route()}.index")
                    ->with("success",__("admin/alert.default_success"));
            } catch (Throwable) {
                return back()
                    ->with("error",__("admin/alert.default_error"));
            }
        }
    }
}
