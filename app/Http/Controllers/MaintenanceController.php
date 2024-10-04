<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    public function index()
    {
        if (config("maintenance.status") == StatusEnum::Active->value) {
            $date = Carbon::parse(config("maintenance.end_date"))->format("m.d.Y");
            return view("common.maintenance", compact("date"));
        } else {
            return redirect()->route("home");
        }
    }
}
