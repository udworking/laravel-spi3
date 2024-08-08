<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
    public function index()
    {
        // user_groupTBLからデータを全取得
        // $userGroups = UserGroup::all();
        // user_groupTBLからdisplay=1を取得
        $userGroups = Usergroup::where('display', 1)->get();
        // 最大のIDを取得
        $maxId = UserGroup::max('id');
        // データをビューに渡す
        return view('user.user_group.index', compact('userGroups', 'maxId'));
    }
    public function edit($id){
        $userGroup = UserGroup::findorFail($id); // $idがないときにエラー(404HTTP)を返す
        return view('user.user_group.edit', compact('userGroup'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'group_id' => 'required|integer|unique:user_group,group_id',
            'group_name' => 'required|string|max:255',
        ]);
        $userGroup = UserGroup::findOrFail($id);
        $userGroup->group_id = $request->group_id;
        $userGroup->group_name = $request->group_name;
        $userGroup->save();

        return redirect() -> route('user_group.index')->with('success', 'User Group updated successfully!');
    }
    public function store(Request $request){
        $request->validate([
            'group_id' => 'required|integer|unique:user_group,group_id',
            'group_name' => 'required|string|max:255',
        ]);
        UserGroup::create($request->only(['group_id', 'group_name']));

        return redirect()->route('user_group.index')->with('success', 'User Group created');
    }
    public function delete($id){
        $userGroup = UserGroup::findOrFail($id);
        $userGroup->display = 0;
        $userGroup->save();

        return redirect()->route('user_group.index')->with('success', 'usergroup deleted successfully!');
    }
}