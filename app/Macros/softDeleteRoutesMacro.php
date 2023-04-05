<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::macro('softDeletes', function () {
    Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
});