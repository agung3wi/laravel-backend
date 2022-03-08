<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/", function() {
    $data = [1,2,3];
    return response()->json([
        "message" => "Success",
        "data" => $data
    ], 404);
});

Route::get("/product", [ProductController::class, "index"]);
Route::post("/product", [ProductController::class, "create"]);
Route::get("/product/{id}", [ProductController::class, "detail"]);
Route::patch("/product/{id}", [ProductController::class, "update"]);
Route::delete("/product/{id}", [ProductController::class, "delete"]);

Route::post('/login', [AuthController::class, "login"]);
