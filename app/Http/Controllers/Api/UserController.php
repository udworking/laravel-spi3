<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // ログファサードをインポート

class UserController extends Controller
{
    public function show($user_id){
        $user = User::with('userGroup')->where('user_id', $user_id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function getAll(){
        $users = User::where('is_member',1)->get();
        if(!$users){
            return response()-> json(['message' => 'no member who can display you'], 404);
        }
        return response()->json($users);
    }
    public function addUser(Request $request){
        // バリデーション
        $request->validate([
            'user_id' =>'required|integer',
            'user_name' => 'required|String|max:100',
            'group_id' => 'required|integer',
            'email' => 'required|email|unique:users,email',
        ]);
        // パスワードをデフォルトに設定
        $defaultPassword = Hash::make('default_password');
        User::create([
            'user_id' => $request->user_id,
            'name' => $request->user_name,
            'group_id' => $request->group_id,
            'email' => $request->email,
            'password' => $defaultPassword,
            'is_member' => 1,
        ]);

        return rsponse()->json($request);
    }
    public function updateUser(Request $request, $id) {
        //バリデーション
        $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'group_id' => 'required|integer',
            'email' =>  'required|email|unique:users,email,' . $id, // ID を除外
        ]);
        try {
            // ユーザーの更新処理
            $user = User::findOrFail($id);
            $user->user_id = $request->user_id;
            $user->name = $request->name;
            $user->group_id = $request->group_id;
            $user->email = $request->email;
            $user->update();
    
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            // エラーをログに記録
            Log::error('Update User Error: ' . $e->getMessage());
            return response()->json(['error' => 'User update failed'], 500);
        }
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->is_member=0;
        $user->update();

        return response()->json([
            'status' => 'success',
            'message' => 'User successfully deleted(hidden)'
        ], 200);
    }
}
