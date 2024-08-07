<!--resources\views\user\user_group\index.blade.php -->
<x-app-layout>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Group_id</title>
            <style>
                table{
                    width: 100%;
                    border-collapse: collapse;
                }
                th,td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .font-color {
                    color: #FFF; /* 文字色を白っぽく設定 */
                }
                .form-control {
                    color: #7d7d7d;
                }
                .btn {
                    display: inline-block;
                    padding: 0.5em 1em;
                    text-decoration: none;
                    background: #668ad8;/*ボタン色*/
                    color: #FFF;
                    border-bottom: solid 4px #627295;
                    border-radius: 3px;
                }
                .btn:active {
                    /*ボタンを押したとき*/
                    -webkit-transform: translateY(4px);
                    transform: translateY(4px);/*下に動く*/
                    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2);/*影を小さく*/
                    border-bottom: none;
                }  
                .btn-delete {
                    display: inline-block;
                    padding: 0.5em 1em;
                    text-decoration: none;
                    background: #d9534f; /* 警告色の赤 */
                    color: #FFF;
                    border-bottom: solid 4px #d43f3a; /* より濃い赤色 */
                    border-radius: 3px;
                }

                .btn-delete:active {
                    /* ボタンを押したとき */
                    -webkit-transform: translateY(4px);
                    transform: translateY(4px); /* 下に動く */
                    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2); /* 影を小さく */
                    border-bottom: none;
                }
                .error {
                    color: red;
                }
            </style>
        </head>
        <body>
            <form method="POST" action="{{ route('user_group.store') }}">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Group ID</th>
                            <th>Group Name</th>
                            <th>Add</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="font-color">
                            <td>{{ $maxId + 1 }}</td>
                            <td>
                                <input type="text" class="form-control" id="group_id" name="group_id"  required>
                                <div id="group_id_error" class="error" style="display:none;">U can inout only number</div>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="group_name" name="group_name" required>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
@foreach ($errors->all() as $error)
  <li class="error">{{$error}}</li>
@endforeach
            <!-- <h1>Group_id</h1> -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group ID</th>
                        <th>Group Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userGroups as $group)
                    <tr class="font-color">
                        <td>{{ $group->id}}</td>
                        <td>{{ $group->group_id}}</td>
                        <td>{{ $group->group_name}}</td>
                        <td>
                            <a href="{{ route('user_group.edit', $group->id) }}" class="btn btn-primary">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('user_group.delete', $group->id) }}">
                                @csrf
                                <button type="submit" class="btn-delete btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </body>
    </html>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const groupIdInput = document.getElementById('group_id');
        const groupIdError = document.getElementById('group_id_error');

        groupIdInput.addEventListener('input', function() {
            // 全角入力を半角に変換
            this.value = this.value.replace(/[０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
            });

            // 数字以外の文字が含まれている場合のエラーメッセージ表示
            if (this.value === '' || /[^0-9]/.test(this.value)) {
                groupIdError.style.display = 'block';
                console.log("入力に問題があります"); // Debug: エラー時のログ
            } else {
                groupIdError.style.display = 'none';
                console.log("入力は正しいです"); // Debug: 正常時のログ
            }
        });
    });
</script>