<?php

use Illuminate\Support\Facades\Route;
use Jeet\Chattle\app\Http\Controllers\Chat\AdminController;
use Jeet\Chattle\app\Http\Controllers\Chat\CreateController;
use Jeet\Chattle\app\Http\Controllers\Chat\GetMessagesController;
use Jeet\Chattle\app\Http\Controllers\Chat\PostMessageController;
use Jeet\Chattle\app\Http\Controllers\Chat\GetChatsController;

Route::prefix('chattle')->group(function () {
    Route::view('chat', 'chattle::chat');
    Route::post('create-chat', CreateController::class);
    Route::post('post-message', PostMessageController::class);
    Route::get('get-messages', GetMessagesController::class);
    Route::get('chat-admin', AdminController::class);
    Route::get('get-chats', GetChatsController::class);
});
