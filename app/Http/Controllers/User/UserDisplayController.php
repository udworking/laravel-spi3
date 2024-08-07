<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;

class UserDisplayController extends Controller
{
    public function show()
    {
        // ログイン中のユーザーを全取得
        // $user = Auth::user();
        $users = User::where('is_member', 1)->with('userGroup')->get();
        // ユーザーに関連するグループ情報も取得
        $users->load('userGroup');
        // グループリストを取得
        $groupList = UserGroup::all();
        // ビューにユーザー情報を渡す
        return view('user.user_display.index', compact('users', 'groupList'));
    }

    public function edit($id){
        $user = User::findorFail($id); //$idがないときにエラー
        return view('user.user_display.edit', compact('user'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'user_id' => 'required|integer',
            'user_name' => 'required|string|max:100',
            'group_id' => 'required|integer',
            'email' => 'required|email',
        ]);
        $user = User::findOrFail($id);
        $user->user_id = $request->user_id;
        $user->name = $request->user_name;
        $user->group_id = $request->group_id;
        $user->email = $request->email;
        $user->save();

        return redirect() -> route('user_display.index')->with('success','User updated successfully!');
    }
    public function store(Request $request){
        // var_dump($request);
        $request->validate([
            'user_id' => 'required|integer',
            'user_name' => 'required|string|max:100',
            'group_id' => 'required|integer',
            'email' => 'required|email|unique:users,email',
        ]);
        // パスワードをデフォルト値に設定
        $defaultPassword = Hash::make('default_password');
        User::create([
            'user_id' => $request->user_id,
            'name' => $request->user_name,
            'group_id' => $request->group_id,
            'email' => $request->email,
            'password' => $defaultPassword,
            'is_member' => 1,
        ]);
    
        
        return redirect()->route('user_display.index')->with('success', 'user created');
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $user->is_member = 0;
        $user-> save();

        return redirect()->route('user_display.index')->with('success','user information deleted successfly!');
    } 
}
