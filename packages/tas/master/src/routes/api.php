<?php

use Illuminate\Support\Facades\Route;
use Tas\Master\Controllers\CustomerLevelController;

Route::get("/", function () {
    return response()->json([
        "message" => "Hello, this is route of master"
    ]);
});

Route::get("/customer-level", [CustomerLevelController::class, "index"]);
