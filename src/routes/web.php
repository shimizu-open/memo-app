<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('memos.index'));

Route::resource('memos', MemoController::class);

// ピン留めの切り替え
Route::patch('/memos/{memo}/pin', [MemoController::class, 'togglePin'])->name('memos.pin');

// コメント（1対多）
Route::post('/memos/{memo}/comments', [CommentController::class, 'store'])->name('memos.comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// リマインダー（1対1）
Route::put('/memos/{memo}/reminder', [ReminderController::class, 'update'])->name('memos.reminder.update');
Route::delete('/memos/{memo}/reminder', [ReminderController::class, 'destroy'])->name('memos.reminder.destroy');

// どのサーバーが返事をしたか（冗長化の実験用。文字だけを返す）
Route::get('/server', fn () => response(config('server.label')."\n")->header('Content-Type', 'text/plain; charset=UTF-8'));