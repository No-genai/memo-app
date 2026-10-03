<?php

use App\Http\Controllers\MemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('memos.index'));

Route::resource('memos', MemoController::class);

// PATCHで受け取り、MemoControllerのpinという処理へ渡す
// URLの {memo} には、変更するメモの番号が入る
Route::patch('/memos/{memo}/pin', [MemoController::class, 'pin'])
    ->name('memos.pin');