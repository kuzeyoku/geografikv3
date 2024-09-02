<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::controller(App\Http\Controllers\SetupController::class)->prefix("setup")->group(function () {
//     Route::get("/", "index")->name("setup.index");
//     Route::post("/store", "store")->name("setup.store");
// });

require __DIR__ . "/admin.php";
require __DIR__ . "/front.php";

Route::fallback(function () {
    return view('errors.404');
});
