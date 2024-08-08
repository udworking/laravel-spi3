<?php
namespace App\Http\Controllers\Api;

use App\Http\controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
    public function getAll(){
        $group = UserGroup::where('display', 1)->get();
        if(!$group){
            return response() -> json(['message' => 'Group are not setting yet'], 404);
        }
        return response()->json($group);
    }
    public function addGroup(Request $request){
        // バリデーション
        $request->validate([
            'group_id' => 'required|integer|unique:user_group,group_id',
            'group_name' => 'required|string|max:255',
            'display' => 'required|integer'
        ]);
        // 新しいグループの作成
        $group = UserGroup::create([
            'group_id' => $request->input('group_id'),
            'group_name' => $request->input('group_name'),
            'display' => $request->input('display'),
        ]);
        $group->save();
        return response()->json($group,201);
    }
    public function updateGroup(Request $request,$id){
        //バリデーション
        $request->validate([
            'group_id' => 'required|integer|unique:user_group,group_id' . $id,
            'group_name' => 'required|string|max:255',
        ]);
        // レコードの更新
        $userGroup = UserGroup::findOrFail($id);
        $userGroup->group_id = $request->group_id;
        $userGroup->group_name = $request->group_name;
        $userGroup->update();
        return response()->json([
            'status' => 'success',
            'message' => 'Group updated successfully',
            'data' => $userGroup
        ], 200);
    }
    public function deleteGroup($id){
        $group = UserGroup::findOrFail($id);
        $group->display =0;
        $group->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Group successfully deleted(hidden)'
        ], 200);
    }
}