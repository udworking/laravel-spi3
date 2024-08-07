<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    // テーブル名を指定
    protected $table = 'user_group';
    // 必要な場合は、主キーの設定
    protected $primarykey = 'id';
    // フィルタリングを許可するカラムを指定
    protected $fillable = [
        'id','group_id','group_name',
    ];
}
