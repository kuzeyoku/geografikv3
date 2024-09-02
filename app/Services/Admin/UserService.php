<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Enums\ModuleEnum;

class UserService extends BaseService
{

    public function __construct(User $user)
    {
        parent::__construct($user, ModuleEnum::User);
    }
}
