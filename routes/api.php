<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserGroupController;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// **********************************************************
// login Route
Route::post('/login', [AuthController::class, 'login']);
// **********************************************************

// **********************************************************
// 認証済ユーザーを取得するルート
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();
    });

    // Sanctumのミドルウェアを使用して、ユーザー情報を取得するエンドポイントを保護
    Route::middleware(['throttle:api'])->group(function(){
        //ユーザー関連****************************************
        // 全ユーザーを取得する
        Route::get('/getall',[UserController::class, 'getAll']);
        // user_idからユーザーを取得する
        Route::get('/users/{user_id}', [UserController::class, 'show']);
        // ユーザーを追加する
        Route::post('adduser',[UserController::class,'addUser']);
        // ユーザー情報を上書きする
        Route::put('/updateuser/{id}',[UserController::class, 'updateUser']);
        // ユーザーを炉売り削除する(displayカラム)
        Route::put('/deleteuser/{id}',[UserController::class, 'deleteUser']);

        //グループ関連****************************************
        // Groupを全取得する
        Route::get('/allgroups', [UserGroupController::class,'getAll']);
        // Groupを追加する
        Route::post('/addgroup', [UserGroupController::class,'addGroup']);
        // Groupを上書き保存する
        Route::put('/updategroup/{id}', [UserGroupController::class, 'updateGroup']);
        // Group を論理削除する(displayカラム)
        Route::put('/deletegroup/{id}', [UserGroupController::class, 'deleteGroup']);
    });
});
// **********************************************************