<?php 

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;

class GroupModalController extends Controller{
    public function show(){
         // モデルが正しく設定されているか確認
        $groupList = Usergroup::all();

        // ビューにデータを渡す
        return view('user.user_display.group-list', compact('groupList'));
        }
}