<!-- resources\views\user\user_display\index.blade.php -->
<x-app-layout>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User information</title>
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

                /* ******************  iframe　の装飾*/
                .iframe {
                    width: 70%; /* iframe の幅を70%に設定 */
                    height: 50vh; /* 高さをビューポートの50%に設定 */
                    margin: 2rem auto; /* 中央に配置し、上下にマージンを設定 */
                    border-radius: 15px; /* 角を丸くする */
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* 軽い影をつける */
                    overflow: hidden; /* iframeの枠外の内容を隠す */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                iframe {
                    width: 100%; /* iframe の幅を親要素に合わせる */
                    height: 100%; /* 高さを親要素に合わせる */
                    border: none; /* 枠線を消す */
                    border-radius: 15px; /* iframeにも角の丸みを適用 */
                }
        </style>
    </head>
    <body>
        <form method="POST" action = "{{ route('user_display.store') }}">
        @csrf
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Group ID </th>
                        <th>Group Name</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="font-color">
                        <td>
                            <input type="text" class="form-control" id="user_id" name="user_id" required>
                            <div id="user_id_error" class="error" style="display:none;">U can input only number</div>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </td>
                        <td>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="group_id" name="group_id" required>
                            <div id="email_error" class="error" style="display:none; "> U can input only email syle</div>
                        </td>
                        <td>
                        <button type="button" id="toggleButton" class="btn btn-secondary">
                            GroupId Supported List
                        </button>
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
        
        <h1 class="font-color">User Information</h1>
        <table>
            <thead>
                <tr class>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Group ID</th>
                    <th>Group Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="font-color">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->group_id }}</td>
                    <td>{{ $user->userGroup ? $user->userGroup->group_name : 'N/A' }}</td>
                    <td><a href="{{ route('user_display.edit', $user->id) }}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form method="POST" action="{{ route('user_display.delete', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn-delete btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
    </html>
    <!---------------------------------- -->
        <!-- Group List Modal -->
        <div class="iframe" >
            <iframe src="http://127.0.0.1:8000/group-list" frameborder="0" style="width:70%;height:50vh; display:none;" id="groupListFrame"></iframe>
        </div>
</x-app-layout>
<script>
    // ボタンのクリックイベントを取得
    document.getElementById('toggleButton').addEventListener('click', function() {
        var iframe = document.getElementById('groupListFrame');
        const iframestyle = document.getElementById('iframe');
        // iframe の表示/非表示を切り替え
        if (iframe.style.display === 'none') {
            iframe.style.display = 'block';
            iframestyle.style.display = 'block';
        } else {
            iframe.style.display = 'none';
            iframestyle.style.display = 'none';
        }
    });
</script>
