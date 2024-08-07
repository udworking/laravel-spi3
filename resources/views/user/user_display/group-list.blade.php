<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Group List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* ダークの背景色 */
            color: #ffffff; /* 白色文字 */
        }
        .table {
            border-color: #4e555b; /* テーブルの境界線もダークモードに */
            color: #fff;
        }
        .table thead th {
            background-color: #495057; /* テーブルヘッダの背景色 */
        }
        .table tbody td {
            background-color: #6c757d; /* テーブルデータセルの背景色 */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Group Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupList as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->group_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
