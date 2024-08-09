<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TopicController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Models\Topic;
use Illuminate\Support\Facades\Redirect;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{id}', [TopicController::class, 'show']);
Route::post('/topics', [TopicController::class, 'store'])->middleware('auth:sanctum');
Route::put('/topics/{id}', [TopicController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/topics/{id}', [TopicController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth:sanctum');
Route::put('/comments/{id}', [CommentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('auth:sanctum');




Route::get('/kpi1', [CommentController::class, 'kpi']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');
