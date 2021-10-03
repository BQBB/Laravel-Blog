<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->group(function(){
    Route::get("/posts/own",[PostController::class,"own"]);
    Route::get("/posts/user/{id}",[PostController::class,"userPosts"]);
    Route::apiResource("posts", PostController::class);
    Route::get("/comments", [CommentController::class,"index"]);
    Route::post("/posts/{id}/comments", [CommentController::class,"store"]);
    Route::get("/posts/{id}/comments", [CommentController::class,"show"]);
    Route::get("/comments/{id}", [CommentController::class,"showComment"]);
    Route::put("/comments/{id}", [CommentController::class,"update"]);
    Route::delete("/comments/{id}", [CommentController::class,"destroy"]);
    Route::post("/comments/{id}/replay", [CommentController::class,"storeReplay"]);
    Route::get("/comments/{id}/replay", [CommentController::class,"showReplys"]);
    Route::post('logout', [AuthController::class,"Logout"]);
    Route::get("/user", function (Request $request) {
        return $request->user();
    });
});

Route::post('login', [AuthController::class,"Login"])->middleware("guest");
Route::post('register', [AuthController::class,"Register"])->middleware("guest");

