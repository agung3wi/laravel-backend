<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
    return response()->json([
        "user" => Auth::guard("sanctum")->user()
    ]);
});


Route::get("/", function () {
    $data = [1, 2, 3];
    return response()->json([
        "message" => "Success",
        "data" => $data
    ]);
});


// Route::middleware('auth:sanctum')->group(function () {
Route::get("/product", [ProductController::class, "index"]);
Route::post("/product", [ProductController::class, "create"]);
Route::get("/product/{id}", [ProductController::class, "detail"]);
Route::patch("/product/{id}", [ProductController::class, "update"]);
Route::delete("/product/{id}", [ProductController::class, "delete"]);
// });

Route::get('/sales', [SaleController::class, "index"]);

Route::post('/login', [AuthController::class, "login"]);

Route::post('/upload', [UploadController::class, "upload"]);

Route::get('/file/{file}', [UploadController::class, "read"]);

Route::get('/cache', function () {

    return Cache::remember('product', 60, function () {
        return DB::table('products')->get();
    });
});

Route::get('/cache/set', function () {
    $products = DB::table("products")->get();
    return Cache::put('listProduct', $products);
});
