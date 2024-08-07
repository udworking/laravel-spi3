<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserDisplayController;
use App\Http\Controllers\User\UserGroupController;
use App\Http\Controllers\User\GroupModalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// user関連情報
Route::get('/user/display',[UserDisplayController::class,'show'])
    ->middleware(['auth', 'verified'])
    ->name('user_display.index');

Route::get('/user/setting', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('setting');

Route::get('user/display/{id}/edit',[UserDisplayController::class,'edit'])
    ->middleware(['auth', 'verified'])
    ->name('user_display.edit');
    
Route::put('user/display/{id}', [UserDisplayController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('user_display.update');

Route::post('user/display/store',[UserDisplayController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('user_display.store');

Route::post('user/display/{id}/delete', [UserDisplayController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('user_display.delete');

// user.group_id情報
Route::get('/user/group_id',[UserGroupController::class,'index'])
    ->middleware(['auth', 'verified'])
    ->name('user_group.index');

Route::get('user/group_id/{id}/edit', [UserGroupController::class,'edit'])
    ->middleware(['auth', 'verified'])
    ->name('user_group.edit');

Route::put('user/group_id/{id}', [UserGroupController::class,'update'])
    ->middleware(['auth', 'verified'])
    ->name('user_group.update');

Route::post('user/group_id/store', [UserGroupController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('user_group.store');

Route::post('user/group_id/{id}/delete', [UserGroupController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('user_group.delete');

// web.php
Route::get('/group-list', [GroupModalController::class, 'show'])->name('group-list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
